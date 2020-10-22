<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Cron;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

class Clean
{
    const DEFAULT_DAYS_TO_CLEAN = 30;
    const CONFIG_DAYS_TO_CLEAN = 'emailcatcher/general/days_to_clean';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Clean constructor.
     *
     * @param LoggerInterface $logger
     * @param ResourceConnection $resourceConnection
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        LoggerInterface $logger,
        ResourceConnection $resourceConnection,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->logger = $logger;
        $this->resourceConnection = $resourceConnection;
        $this->connection = $this->resourceConnection->getConnection();
        $this->scopeConfig = $scopeConfig;
    }

    public function getDaysToClean()
    {
        $daysToCleanConfig = $this->scopeConfig->getValue(self::CONFIG_DAYS_TO_CLEAN, ScopeInterface::SCOPE_STORE);
        
        return (int)$daysToCleanConfig >= 0 ? $daysToCleanConfig : self::DEFAULT_DAYS_TO_CLEAN;
    }

    /**
     * Execute the cron
     *
     * @return int $deletionCount
     */
    public function execute()
    {
        $where = "created_at < '" . date('c', time() - ($this->getDaysToClean() * (3600 * 24))) . "'";

        $deletionCount = $this->connection->delete(
            $this->resourceConnection->getTableName('experius_emailcatcher'),
            $where
        );

        $this->logger->addInfo(__('Experius EmailCatcher Cleanup: Removed %1 records', $deletionCount));

        return (int)$deletionCount;
    }
}
