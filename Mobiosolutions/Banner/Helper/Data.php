<?php

/**
 * Copyright © 2015 Mobiosolutions . All rights reserved.
 */

namespace Mobiosolutions\Banner\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_storeManager = $storeManager;
    }

    /**
     *   Get collection of all cms pages
     *  return array
     */
    public function getCmsPages() {
        $pageArray = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $pagesCollection = $objectManager->create('Magento\Cms\Model\Page')->getCollection()->getData();
        if (count($pagesCollection) > 0) {
            foreach ($pagesCollection as $key => $values) {
                $valueArray = array('value' => $values['page_id'], 'label' => $values['title']);
                array_push($pageArray, $valueArray);
            }
        }
        return $pageArray;
    }

    /**
     *   Get collection of all categories
     *  return array
     */
    public function getCategories() {

        $cateogyrArray = array();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $categoryFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $categories = $categoryFactory->create()->addAttributeToSelect('*')->setStore($this->_storeManager->getStore());

        $level1 = "--";
        $level2 = "----";
        $level3 = "------";

        foreach ($categories as $category) {
            $pattern = "";
            $pattern = ($category->getLevel() == 1) ? ($level1) : ($pattern);
            $pattern = ($category->getLevel() == 2) ? ($level2) : ($pattern);
            $pattern = ($category->getLevel() == 3) ? ($level3) : ($pattern);
            $valueArray = array('value' => $category->getId(), 'label' => $pattern . ' ' . $category->getName());
            array_push($cateogyrArray, $valueArray);
        }
        return $cateogyrArray;
    }

}
