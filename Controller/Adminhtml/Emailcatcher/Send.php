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

use Experius\EmailCatcher\Model\Mail;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

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
     * @param PageFactory $resultPageFactory
     * @param Mail $mail
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
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
        $this->messageManager->addSuccessMessage('Email send to ' . $email);

        return $resultRedirect->setPath('*/*/');
    }
}
