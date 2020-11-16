<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\Emailcatcher;

use Experius\EmailCatcher\Model\Mail;
use Magento\Backend\App\Action\Context;

class Send extends \Magento\Backend\App\Action
{
    /**
     * @var Mail
     */
    protected $mail;

    /**
     * Send constructor.
     *
     * @param Context $context
     * @param Mail $mail
     */
    public function __construct(
        Context $context,
        Mail $mail
    ) {
        parent::__construct($context);
        $this->mail = $mail;
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
            $this->messageManager->addError('Oops, something went wrong');
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
