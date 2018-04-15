<?php

namespace Mobiosolutions\Banner\Controller\Adminhtml\BannerGrid;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Mobiosolutions\Banner\Model\ResourceModel\Banner\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action {

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute() {

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        try {
            foreach ($collection as $item) {
                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                $files = $this->_objectManager->create('Magento\Framework\Filesystem\Driver\File');
                $ImageName = str_replace('/bannerslider/images', '', $item->getBannerImage());
                if ($files->isExists($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName)) {
                    $files->deleteFile($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName);
                }
                $item->delete();
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $collectionSize));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }

}
