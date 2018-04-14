<?php

namespace Mobiosolutions\Banner\Controller\Adminhtml\BannerGrid;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action {
	 
    public function execute() {

        $data = $this->getRequest()->getParams();
        $postData = $this->getRequest()->getPostValue();		
        if ($data) {
            $model = $this->_objectManager->create('Mobiosolutions\Banner\Model\Banner');
            $id = $this->getRequest()->getParam('banner_id');
            if ($id) {
                $model->load($id);
            }
			$httpFactory = $this->_objectManager->create('Magento\Framework\HTTP\Adapter\FileTransferFactory');
			$adapter = $httpFactory->create();						
            if ($adapter->isUploaded('banner_image')) {
                try {							
					$uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader',['fileId' => 'banner_image']);
					$banner = $uploader->validateFile();
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                    $files = $this->_objectManager->create('Magento\Framework\Filesystem\Driver\File');

                    try {                        
                        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(true);
                        $result = $uploader->save($mediaDirectory->getAbsolutePath('bannerslider/images'));
                    } catch (\Exception $e) {
                        $this->messageManager->addError($e->getMessage());
                        if ($id) {
                            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                            return;
                        } else {
                            $this->_redirect('*/*/new');
                            return;
                        }
                    }

                    // Remove Image 
                    if (isset($data['banner_image'])) {
                        $ImageName = str_replace('/bannerslider/images', '', $data['banner_image']['value']);
                        if ($files->isExists($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName)) {
                            $files->deleteFile($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName);
                        }
                    }

                    unset($result['tmp_name']);
                    unset($result['path']);
                    $data['banner_image'] = $result['file'];
                } catch (\Exception $e) {
                    $data['banner_image'] = $banner['name'];
                }
            } else {
                $data['banner_image'] = str_replace('/bannerslider/images', '', $data['banner_image']['value']);
            }
			$banner_type_ids = (isset($data['cms_page'])) ? $data['cms_page'] : $data['category'];
            $data['banner_type_ids'] = implode(',', $banner_type_ids);			
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('Banner has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/index');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {

                $this->messageManager->addException($e, __($e->getMessage() . ' Something went wrong while saving the Banner.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
        $this->_redirect('*/*/index');
    }

}
