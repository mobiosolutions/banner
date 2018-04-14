<?php
/**
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mobiosolutions\Banner\Controller\Adminhtml\BannerGrid;

use Mobiosolutions\Banner\Model\BannerFactory;
use Magento\Cms\Model\Wysiwyg as WysiwygModel;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreFactory;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Registry;

class Builder
{
    /**
     * @var \Mobiosolutions\Banner\Model\BannerFactory
     */
    protected $productFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $wysiwygConfig;

    /**
     * @var StoreFactory
     */
    protected $storeFactory;

    /**
     * @param BannerFactory $productFactory
     * @param Logger $logger
     * @param Registry $registry
     * @param WysiwygModel\Config $wysiwygConfig
     */
    public function __construct(
        BannerFactory $productFactory,
        Logger $logger,
        Registry $registry,
        WysiwygModel\Config $wysiwygConfig
    ) {
        $this->productFactory = $productFactory;
        $this->logger = $logger;
        $this->registry = $registry;
        $this->wysiwygConfig = $wysiwygConfig;
    }

    /**
     * Build product based on user request
     *
     * @param RequestInterface $request
     * @return \Magento\Catalog\Model\Product
     */
    public function build(RequestInterface $request)
    {
        $productId = (int)$request->getParam('id');
        /** @var $product \Mobiosolutions\Banner\Model\Banner */
        $product = $this->productFactory->create();



        $product->setData('_edit_mode', true);
        if ($productId) {
            try {
                $product->load($productId);
            } catch (\Exception $e) {
                $product->setTypeId(\Magento\Catalog\Model\Product\Type::DEFAULT_TYPE);
                $this->logger->critical($e);
            }
        }
        $this->registry->register('banner_banner', $product);
        return $product;
    }
}
