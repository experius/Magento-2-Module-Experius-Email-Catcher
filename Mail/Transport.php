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

namespace Experius\EmailCatcher\Mail;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Store\Model\ScopeInterface;

class Transport implements TransportInterface
{

    const XML_PATH_SENDING_SET_RETURN_PATH = 'system/smtp/set_return_path';

    const XML_PATH_SENDING_RETURN_PATH_EMAIL = 'system/smtp/return_path_email';

    private $transport;

    private $message;

    private $scopeConfig;

    private $emailCatcher;

    public function __construct(
        \Zend_Mail_Transport_Sendmail $transport,
        MessageInterface $message,
        ScopeConfigInterface $scopeConfig,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
    ) {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }

        $this->transport = $transport;
        $this->message = $message;
        $this->scopeConfig = $scopeConfig;
        $this->emailCatcher = $emailCatcher;
    }

    public function sendMessage(\Magento\Framework\Mail\Message $message = null)
    {

        $message = (is_null($message)) ? $this->message : $message;

        if ($this->scopeConfig->getValue('emailcatcher/general/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            $this->emailCatcher->create()->saveMessage($message);
        }

        if ($this->scopeConfig->getValue('system/smtp/disable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            return;
        }


        if ($this->scopeConfig->getValue('emailcatcher/general/smtp_disable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            return;
        }

        try {
            $isSetReturnPath = $this->scopeConfig->getValue(
                self::XML_PATH_SENDING_SET_RETURN_PATH,
                ScopeInterface::SCOPE_STORE
            );
            $returnPathValue = $this->scopeConfig->getValue(
                self::XML_PATH_SENDING_RETURN_PATH_EMAIL,
                ScopeInterface::SCOPE_STORE
            );

            if ($isSetReturnPath == '1') {
                $this->message->setReturnPath($message->getFrom());
            } elseif ($isSetReturnPath == '2' && $returnPathValue !== null) {
                $this->message->setReturnPath($returnPathValue);
            }
            $this->transport->send($message);
        } catch (\Exception $e) {
            throw new MailException(__($e->getMessage()), $e);
        }
    }

    public function getMessage()
    {
        return $this->message;
    }
}
