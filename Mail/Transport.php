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

    private $emailTemplateId;

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
        $catcherEnabled = $this->scopeConfig->getValue('emailcatcher/general/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $systemSmtpDisable = $this->scopeConfig->getValue('system/smtp/disable',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $emailCatcherSmtpDisable = $this->scopeConfig->getValue('emailcatcher/general/smtp_disable',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $whitelistEnabled = $this->scopeConfig->getValue('emailcatcher/whitelist/apply_whitelist',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $message = (is_null($message)) ? $this->message : $message;

        if ($catcherEnabled) {
            $this->emailCatcher->create()->saveMessage($message);
        }

        if ($systemSmtpDisable || $emailCatcherSmtpDisable) {
            if (!$whitelistEnabled) {
                return;
            }

            $whitelistedTemplates = $this->scopeConfig->getValue('emailcatcher/whitelist/email_templates', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $whitelistedTemplates = explode(',',$whitelistedTemplates);
            $whitelisted = in_array($this->emailTemplateId,$whitelistedTemplates);

            if ($whitelistEnabled && !$whitelisted) {
                return;
            }
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

    public function setEmailTemplateId($emailTemplateId) {
        $this->emailTemplateId = $emailTemplateId;
    }
}
