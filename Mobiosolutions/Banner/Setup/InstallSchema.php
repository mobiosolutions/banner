<?php

/**
 * Copyright © 2015 Mobiosolutions. All rights reserved.
 */

namespace Mobiosolutions\Banner\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface {

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {

        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'banner_banner'
         */
        $table = $installer->getConnection()->newTable(
                        $installer->getTable('banner_banner')
                )
                ->addColumn(
                        'banner_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'banner_banner'
                )
                ->addColumn(
                        'banner_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'banner_name'
                )
                ->addColumn(
                        'link', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'link'
                )
                ->addColumn(
                        'banner_type', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, [], 'banner_type'
                )
                ->addColumn(
                        'banner_type_ids', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 500, [], 'banner_type_ids'
                )
                ->addColumn(
                        'banner_image', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'banner_image'
                )
                ->addColumn(
                        'sort_order', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, [], 'sort_order'
                )
                ->addColumn(
                    'status', \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT, null, [], 'status'
                )
                ->addColumn(
                        'creation_time', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT], 'Banner Creation Time'
                )->addColumn(
                        'update_time', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE], 'Banner Modification Time'
                )
                /* {{CedAddTableColumn}}} */
                ->setComment(
                'Mobiosolutions Banner banner_banner'
        );

        $installer->getConnection()->createTable($table);
        /* {{CedAddTable}} */

        $installer->endSetup();
    }

}
