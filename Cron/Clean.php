<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Cron;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

class Clean
{
    public const DEFAULT_DAYS_TO_CLEAN = 30;
    public const CONFIG_DAYS_TO_CLEAN = 'emailcatcher/general/days_to_clean';

    protected AdapterInterface $connection;

    /**
     * @param LoggerInterface $logger
     * @param ResourceConnection $resourceConnection
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        protected LoggerInterface $logger,
        protected ResourceConnection $resourceConnection,
        protected ScopeConfigInterface $scopeConfig
    ) {
        $this->connection = $this->resourceConnection->getConnection();
    }

    /**
     * Get days to clean
     *
     * @return int
     */
    public function getDaysToClean(): int
    {
        $daysToCleanConfig = $this->scopeConfig->getValue(self::CONFIG_DAYS_TO_CLEAN, ScopeInterface::SCOPE_STORE);

        return (int)$daysToCleanConfig >= 0 ? (int)$daysToCleanConfig : self::DEFAULT_DAYS_TO_CLEAN;
    }

    /**
     * Execute the cron
     *
     * @return int $deletionCount
     */
    public function execute(): int
    {
        $where = "created_at < '" . date('c', time() - ($this->getDaysToClean() * (3600 * 24))) . "'";

        $deletionCount = $this->connection->delete(
            $this->resourceConnection->getTableName('experius_emailcatcher'),
            $where
        );

        $this->logger->info(__('Experius EmailCatcher Cleanup: Removed %1 records', $deletionCount));

        return $deletionCount;
    }
}
