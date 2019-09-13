<?php

namespace Experius\EmailCatcher\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            $connection = $setup->getConnection();
            
            if ($connection->tableColumnExists('experius_emailcatcher', 'to')) {
                $connection->changeColumn(
                    'experius_emailcatcher',
                    'to',
                    'recipient',
                    ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT]
                );
            }

            if ($connection->tableColumnExists('experius_emailcatcher', 'from')) {
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
