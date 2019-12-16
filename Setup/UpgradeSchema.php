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
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @inheritDoc
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            $connection = $setup->getConnection();
            if (!$connection->tableColumnExists('experius_emailcatcher', 'recipient')) {
                $connection->changeColumn(
                    'experius_emailcatcher',
                    'to',
                    'recipient',
                    ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT]
                );
            }
            if (!$connection->tableColumnExists('experius_emailcatcher', 'sender')) {
                $connection->changeColumn(
                    'experius_emailcatcher',
                    'from',
                    'sender',
                    ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT]
                );
            }
        }
    }
}