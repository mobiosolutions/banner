<?php
namespace Mobiosolutions\Banner\Controller\Adminhtml\BannerGrid;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $_resultPage;
    protected $_authorization;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        //Call page factory to render layout and page content
        $this->_setPageData();
        return $this->getResultPage();
    }

    /*
     * Check permission via ACL resource
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mobiosolutions_BannerGrid::index');
    }

    public function getResultPage()
    {
        if (is_null($this->_resultPage)) {
            $this->_resultPage = $this->resultPageFactory->create();
        }
        return $this->_resultPage;
    }

    protected function _setPageData()
    {
        $resultPage = $this->getResultPage();
        $resultPage->setActiveMenu('Mobiosolutions_Banner::ms_bannergrid_index');
        $resultPage->getConfig()->getTitle()->prepend((__('Banners')));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Mobiosolutions'), __('Manage Banners'));
        $resultPage->addBreadcrumb(__('Mobiosolutions'), __('Manage Banners'));

        return $this;
    }


}