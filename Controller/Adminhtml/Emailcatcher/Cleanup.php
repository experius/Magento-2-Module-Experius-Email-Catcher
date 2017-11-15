<?php
/**
 * A Magento 2 module named Experius/EmailCatcher
 * Copyright (C) 2016 Derrick Heesbeen
 *
 * This file included in Experius/EmailCatcher is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Experius\EmailCatcher\Controller\Adminhtml\Emailcatcher;

class Cleanup extends \Magento\Backend\App\Action
{

    protected $clean;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Experius\EmailCatcher\Cron\Clean $clean
    ) {
        $this->clean = $clean;

        parent::__construct($context);
    }


    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $deleteCount = $this->clean->execute();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            return $resultRedirect->setPath('*/*/');
        }

        $this->messageManager->addSuccessMessage(__('Removed %1 records from %2 days ago or older', $deleteCount, '30'));

        return $resultRedirect->setPath('*/*/');
    }
}
