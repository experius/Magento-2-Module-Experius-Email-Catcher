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
use Magento\Framework\Mail\MessageInterface;

class Transport extends \Magento\Email\Model\Transport
{

    private $transport;

    private $message;

    private $scopeConfig;

    public function __construct(
        \Zend_Mail_Transport_Sendmail $transport,
        MessageInterface $message,
        ScopeConfigInterface $scopeConfig
    ) {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }
        $this->transport = $transport;
        $this->message = $message;
        $this->scopeConfig = $scopeConfig;

        parent::__construct($transport, $message, $scopeConfig);
    }

    public function setMessage(\Magento\Framework\Mail\Message $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
