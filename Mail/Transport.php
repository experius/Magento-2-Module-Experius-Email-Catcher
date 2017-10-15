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

class Transport extends \Zend_Mail_Transport_Sendmail implements \Magento\Framework\Mail\TransportInterface
{

    protected $_message;
    
    protected $_emailCatcher;
    
    protected $_parameters;
    
    protected $_templateOptions;
    
    protected $_templateVars;
    
    protected $_scopeConfig;

    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        $parameters = null
    )
    {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }
        parent::__construct($parameters);
        $this->_message = $message;
        $this->_emailCatcher = $emailCatcher;
        $this->_parameters = $parameters;
        $this->_scopeConfig = $scopeConfig;
    }
    
    public function sendMessage(\Magento\Framework\Mail\Message $message = Null)
    {
        $message = (is_null($message)) ? $this->_message : $message;

        if($this->_scopeConfig->getValue('emailcatcher/general/enabled',\Magento\Store\Model\ScopeInterface::SCOPE_STORE)) {
            $this->_emailCatcher->create()->saveMessage($message);
        }

        if(!$this->_scopeConfig->getValue('emailcatcher/general/smtp_disable',\Magento\Store\Model\ScopeInterface::SCOPE_STORE)){
            try {
                parent::send($message);
            } catch (\Exception $e) {
                throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
            }
        }
    }

    public function getMessage()
    {
        return $this->_message;
    }
}
