<?php

namespace Mobiosolutions\Banner\Block\Index;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Banner block
 */
class Banner extends \Magento\Framework\View\Element\Template  {

    const SLIDER_STATUS = 'banner/configuration/active';
    const ENABLE_CMS_SLIDER = 'banner/configuration/active_cms';
    const ENABLE_CATEGORY_SLIDER = 'banner/configuration/active_category';
    const SLIDER_EFFECT = 'banner/configuration/effect';
    const SLIDER_FULL_WIDTH = 'banner/configuration/full_width';
    const SLIDER_DURATION = 'banner/configuration/duration';
    const SLIDER_DELAY = 'banner/configuration/delay';
    const SLIDER_AUTOPLAY = 'banner/configuration/autoplay';
    const SLIDER_NAVIGATION_BUTTON = 'banner/configuration/navigation';

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager = null;

    /*
     * Request instance
     * 
     * @var \Magento\Framework\App\Request\Http 
     */
    protected $_request;
    
    /*
     * CMS Page Instance
     * 
     * @var \Magento\Cms\Model\Page
     */
    protected $cmsPage;
    /*
     * Helper Instance
     * 
     * @var \Mobiosolutions\Banner\Helper\Data 
     */
    protected $_dataHelper;

    /*
     * DirectoryList Instance
     * 
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    protected $_directory;
    /**
     * Block constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
	 * @param \Magento\Framework\App\Request\Http $request 	
     * @param \Magento\Cms\Model\Page $cmsPage
     * @param \Mobiosolutions\Banner\Helper\Data $helper
     * @param \Magento\Framework\App\Filesystem\DirectoryList $DirectoryList
     * 
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, array $data = array(), \Magento\Framework\App\Request\Http $request, \Magento\Cms\Model\Page $cmsPage, \Mobiosolutions\Banner\Helper\Data $helper, \Magento\Framework\App\Filesystem\DirectoryList $DirectoryList) {
        parent::__construct($context, $data);
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->_request = $request;        
        $this->cmsPage = $cmsPage;
        $this->_dataHelper = $helper;
        $this->_directory = $DirectoryList;
		$this->scopeConfig = $context->getScopeConfig();
    }

    public function getTitle() {
        return "Home Slider";
    }

    /*
     * Get Banner Collection 
     * return array()
     */

    public function getDataCollection($bannerType='',$id=0) {
		$searchField = ($bannerType == \Mobiosolutions\Banner\Model\Banner::BANNER_TYPE_CMS) ? 'cms_page' : 'category';
        $productCollection = $this->objectManager->create('Mobiosolutions\Banner\Model\ResourceModel\Banner\CollectionFactory');
         return $productCollection->create()->addFieldToSelect(['banner_image','link','banner_name'])->load()->addFieldToFilter('banner_type', ['eq' => "$bannerType"])
			   ->addFieldToFilter('status', ['eq' => "1"])
			   ->addFieldToFilter('banner_type_ids', ['finset' => [$id]])
			   ->setOrder('sort_order', 'ASC')->getData();
    }

    public function checkPageType() {
        if ($this->isCmsPage() && $this->getScopeConfugValue(self::ENABLE_CMS_SLIDER)) {
            return $this->getCmsPageBanner();
        }

        if ($this->isCategoryPage() && $this->getScopeConfugValue(self::ENABLE_CATEGORY_SLIDER)) {
            return $this->getCategoryPageBanner();
        }
    }
	
	public function getCmsPageBanner() {
        $imageArray = [];
        $pageId = $this->_request->getParam('page_id', 0);
		$pageId = ($pageId == 0) ? $this->cmsPage->getId() : $pageId;
        return $bannerData = $this->getDataCollection(\Mobiosolutions\Banner\Model\Banner::BANNER_TYPE_CMS,$pageId); // here 1 means cms page
    }

    public function getCategoryPageBanner() {
        $imageArray = [];
        $category = $this->objectManager->get('Magento\Framework\Registry')->registry('current_category'); //get current category
        $categoryId = $category->getId();
        $bannerData = $this->getDataCollection(\Mobiosolutions\Banner\Model\Banner::BANNER_TYPE_CATEGORY,$categoryId); // here 2 means categories        		
		return $bannerData;
    }

    public function getBannerCollection() {
        if (self::SLIDER_STATUS) {
            return $this->checkPageType();
        } else {
            return array();
        }
    }

    protected function isCategoryPage() {
        if ($this->_request->getFullActionName() == 'catalog_category_view') {
            return true;
        }
		return false;
    }

    protected function isCmsPage() {		
		if($this->_request->getFullActionName() == 'cms_page_view' || $this->_request->getFullActionName() == 'cms_index_index') {
			return true;
		}
		return false;
    }

    public function getScopeConfugValue($path) {		
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getBannerPath() {
        $store = $this->objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        return $imageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'bannerslider/images';
    }

}
