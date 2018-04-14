<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mobiosolutions\Banner\Model\ResourceModel\Banner;

/**
 * Banners Collection
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * ID Field Name
     *
     * @var string
     */
    //protected $_idFieldName = 'id';
    protected $_idFieldName = \Mobiosolutions\Banner\Model\Banner::BANNER_ID;
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'ms_banner_grid_collection';
    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'banner_grid_collection';
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Mobiosolutions\Banner\Model\Banner', 'Mobiosolutions\Banner\Model\ResourceModel\Banner');
    }

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(\Zend_Db_Select::GROUP);
        return $countSelect;
    }
    /**
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     * @return array
     */
    protected function _toOptionArray($valueField = 'banner_id', $labelField = 'banner_name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
}
