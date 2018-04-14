<?php
/**
 * Copyright © 2015 Mobiosolutions. All rights reserved.
 */

namespace Mobiosolutions\Banner\Model;

use Magento\Framework\Exception\BannerException;
use Mobiosolutions\Banner\Api\Data\BannerInterface;

/**
 * Bannertab banner model
 */
class Banner extends \Magento\Framework\Model\AbstractModel implements BannerInterface
{

	const BANNER_TYPE_CMS = '1';
	const BANNER_TYPE_CATEGORY = '2';
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\Db $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Mobiosolutions\Banner\Model\ResourceModel\Banner');
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::BANNER_ID);
    }

    /**
     * Retrieve block identifier
     *
     * @return string
     */
    public function getBannerName()
    {
        return (string)$this->getData(self::BANNER_NAME);
    }

    /**
     * Retrieve block title
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Retrieve block creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Retrieve block update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return BlockInterface
     */
    public function setId($id)
    {
        return $this->setData(self::BANNER_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return BlockInterface
     */
    public function setBannerName($bannername)
    {
        return $this->setData(self::BANNER_NAME, $bannername);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return BlockInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BlockInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return BlockInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }
}