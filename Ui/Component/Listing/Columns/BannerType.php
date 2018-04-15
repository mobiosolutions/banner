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

class BannerType implements \Magento\Framework\Option\ArrayInterface {

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return [['value' => 1, 'label' => __('Cms Page')], ['value' => 2, 'label' => __('Category Page')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray() {
        return [2 => __('Category Page'), 1 => __('Cms Page')];
    }

}
