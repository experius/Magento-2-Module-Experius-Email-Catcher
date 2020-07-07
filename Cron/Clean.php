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
        $daysToClean = self::DEFAULT_DAYS_TO_CLEAN;
        $daysToCleanConfig = $this->scopeConfig->getValue(self::CONFIG_DAYS_TO_CLEAN, ScopeInterface::SCOPE_STORE);

        if((int)$daysToCleanConfig > 0){
            $daysToClean = $daysToCleanConfig;
        }

        return $daysToClean;
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
