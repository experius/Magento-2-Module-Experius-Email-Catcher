<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\EmailCatcher;

use Experius\EmailCatcher\Model\Mail;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Send extends Action
{
    /**
     * @param Context $context
     * @param Mail $mail
     */
    public function __construct(
        Context $context,
        protected Mail $mail
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $postData = $this->getRequest()->getParams();

        $email = (isset($postData['email'])) ? $postData['email'] : false;
        $emailCatcherId = (isset($postData['emailcatcher_id'])) ? $postData['emailcatcher_id'] : false;

        if (!$emailCatcherId) {
            $this->messageManager->addErrorMessage('Oops, something went wrong');
            return $resultRedirect->setPath('*/*/');
        }

        $this->mail->sendMessage($emailCatcherId, $email);
        if ($email) {
            $this->messageManager->addSuccessMessage('Email send to ' . $email);
        } else {
            $this->messageManager->addSuccessMessage('Email was resent');
        }

        return $resultRedirect->setPath('*/*/');
    }
}
