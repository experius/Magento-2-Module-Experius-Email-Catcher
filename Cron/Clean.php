<?php


namespace Experius\EmailCatcher\Cron;

class Clean
{

    protected $logger;

    protected $resourceConnection;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->resourceConnection = $resourceConnection;
        $this->connection = $this->resourceConnection->getConnection();
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {

        $numberOfDays = 30;

        $where = "created_at < '" . date('c', time()-($numberOfDays*(3600*24))) ."'";

        $deleteCount = $this->connection->delete(
            $this->resourceConnection->getTableName('experius_emailcatcher'),
            $where
        );

        $this->logger->addInfo(__('Experius EmailCatcher Cleanup: Removed %1 records', $deleteCount));

        return $deleteCount;
    }
}
