<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\EmailCatcher;

use Exception;
use Experius\EmailCatcher\Cron\Clean;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Cleanup extends Action
{
    /**
     * @param Context $context
     * @param Clean $clean
     */
    public function __construct(
        Context $context,
        protected Clean $clean
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $deleteCount = $this->clean->execute();
        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/');
        }

        $this->messageManager->addSuccessMessage(
            __('Removed %1 records from %2 days ago or older', $deleteCount, $this->clean->getDaysToClean())
        );

        return $resultRedirect->setPath('*/*/');
    }
}
