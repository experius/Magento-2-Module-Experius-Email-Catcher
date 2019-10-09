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

namespace Experius\EmailCatcher\Controller\Adminhtml\Emailcatcher;

use Experius\EmailCatcher\Cron\Clean;
use Magento\Backend\App\Action\Context;

class Cleanup extends \Magento\Backend\App\Action
{
    /**
     * @var Clean
     */
    protected $clean;

    /**
     * Cleanup constructor.
     *
     * @param Context $context
     * @param Clean $clean
     */
    public function __construct(
        Context $context,
        Clean $clean
    ) {
        parent::__construct($context);
        $this->clean = $clean;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $deleteCount = $this->clean->execute();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/');
        }

        $this->messageManager->addSuccessMessage(
            __('Removed %1 records from %2 days ago or older', $deleteCount, (string)Clean::DAYS_TO_CLEAN)
        );

        return $resultRedirect->setPath('*/*/');
    }
}
