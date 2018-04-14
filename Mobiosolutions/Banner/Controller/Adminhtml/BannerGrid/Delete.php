<?php

namespace Mobiosolutions\Banner\Controller\Adminhtml\BannerGrid;

use Magento\Framework\App\Filesystem\DirectoryList;

class Delete extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {
        $id = $this->getRequest()->getParam('id');
        try {
            $banner = $this->_objectManager->get('Mobiosolutions\Banner\Model\Banner')->load($id);

            $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                    ->getDirectoryRead(DirectoryList::MEDIA);

            $files = $this->_objectManager->create('Magento\Framework\Filesystem\Driver\File');
            $ImageName = str_replace('/bannerslider/images', '', $banner->getBannerImage());
            if ($files->isExists($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName)) {
                $files->deleteFile($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName);
            }

            $banner->delete();
            $this->messageManager->addSuccess(
                    __('Banner Delete successfully !')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }

}
