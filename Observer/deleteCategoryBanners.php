<?php
namespace Mobiosolutions\Banner\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\DataObject as Object;
use Magento\Store\Model\StoreManager;
use Magento\Framework\App\Filesystem\DirectoryList;

class deleteCategoryBanners implements ObserverInterface
{
    
	public function __construct(
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Backend\Model\Session $backendSession
	) {
		$this->_objectManager = $objectManager;
		$this->backendSession = $backendSession;		
	}
	
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
		$categoryObject = $observer->getObject()->getCategory();		
		$categoryBannerCollection = $this->_objectManager->create('Mobiosolutions\Banner\Model\BannerFactory')->create()->getCollection();
        $categoryBannerCollection->load()->addFieldToFilter('banner_type_ids', ['finset' => [$categoryObject->getId()]]);		
		if($categoryBannerCollection->getSize() == 0) {
			return $this;
		}
		foreach ($categoryBannerCollection as $item) {
			$cmsPages = explode(",",$item->getBannerTypeIds());
			if(count($cmsPages) > 1) {
				if (($key = array_search($categoryObject->getId(), $cmsPages)) !== false) {
					unset($cmsPages[$key]);
				}
				$bannerModel = $this->_objectManager->create('Mobiosolutions\Banner\Model\Banner')->load($item->getId());
				$bannerModel->setBannerTypeIds(implode(",",$cmsPages));
				$bannerModel->save();
			}else{
				$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
				$files = $this->_objectManager->create('Magento\Framework\Filesystem\Driver\File');
				$ImageName = str_replace('/bannerslider/images', '', $item->getBannerImage());
				if ($files->isExists($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName)) {
					$files->deleteFile($mediaDirectory->getAbsolutePath('bannerslider/images') . $ImageName);
				}
				$item->delete();
			}
		}
    }
}