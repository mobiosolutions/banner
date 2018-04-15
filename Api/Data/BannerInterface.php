<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mobiosolutions\Banner\Api\Data;

/**
 * CMS block interface.
 * @api
 */
interface BannerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const BANNER_ID      = 'banner_id';
    const BANNER_NAME    = 'banner_name';
    const STATUS         = 'status';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getBannerName();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Set ID
     *
     * @param int $id
     * @return BlockInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return BlockInterface
     */
    public function setBannerName($bannername);

    /**
     * Set title
     *
     * @param string $title
     * @return BlockInterface
     */
    public function setStatus($status);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return BlockInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return BlockInterface
     */
    public function setUpdateTime($updateTime);
}
