<?php
/**
 * Copyright © 2015 Mobiosolutions. All rights reserved.
 */
namespace Mobiosolutions\Banner\Model\ResourceModel;

/**
 * Banner resource
 */
class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_resources;

    protected $request;
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('banner_banner', 'banner_id');
    }

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\App\Request\Http $request,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->request = $request;
    }

    protected function _afterLoad( \Magento\Framework\Model\AbstractModel $object ) {
        $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
            ->get('Magento\Framework\App\ResourceConnection');
        $connection= $this->_resources->getConnection();
        return parent::_afterLoad( $object );
    }

    protected function _afterSave( \Magento\Framework\Model\AbstractModel $object ) {
        $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()
            ->get('Magento\Framework\App\ResourceConnection');
        $connection= $this->_resources->getConnection();
        $postData = $this->request->getPostValue();
        return $this;
    }
}
