<?php
/**
 * A Magento 2 module named Experius/EmailCatcher
 * Copyright (C) 2019 Experius
 *
 * This file included in Experius/EmailCatcher is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Experius\EmailCatcher\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @inheritDoc
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $table_experius_emailcatcher = $setup->getConnection()->newTable($setup->getTable('experius_emailcatcher'));
        $table_experius_emailcatcher->addColumn(
            'emailcatcher_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,],
            'Entity ID'
        );
        $table_experius_emailcatcher->addColumn(
            'to',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'To Email Address'
        );
        $table_experius_emailcatcher->addColumn(
            'from',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'From Email Address'
        );
        $table_experius_emailcatcher->addColumn(
            'subject',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Subject'
        );
        $table_experius_emailcatcher->addColumn(
            'body',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'Email Body'
        );
        $table_experius_emailcatcher->addColumn(
            'created_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
            null,
            [],
            'Created At'
        );
        $table_experius_emailcatcher->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'Store Id'
        );
        $setup->getConnection()->createTable($table_experius_emailcatcher);
        $setup->endSetup();
    }
}
