<?php

/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Used in creating options for Yes|No config value selection
 *
 */

namespace Mobiosolutions\Banner\Ui\Component\Listing\Columns;

class BannerStatus implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [['value' => 1, 'label' => __('Active')], ['value' => 2, 'label' => __('Inactive')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray() {
        return [2 => __('Inactive'), 1 => __('Active')];
    }
}