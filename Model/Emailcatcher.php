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

namespace Experius\EmailCatcher\Model;

class Emailcatcher extends \Magento\Framework\Model\AbstractModel
{

    protected $_eventPrefix = 'experius_email_catcher';

    protected $_eventObject = 'email';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Experius\EmailCatcher\Model\ResourceModel\Emailcatcher');
    }

    public function saveMessage(\Magento\Framework\Mail\Message $message)
    {
        $bodyObject  = $message->getBody();

        if (!method_exists($bodyObject, 'getRawContent') && method_exists($message, 'getRawMessage')) {
            $zendMessageObject = new \Zend\Mail\Message();
            $zendMessage = $zendMessageObject::fromString($message->getRawMessage());
            $body =  $zendMessage->getBodyText();
            $to = $this->getEmailAddressesFromObject($zendMessage->getTo());
            $from = $this->getEmailAddressesFromObject($zendMessage->getFrom());
        } elseif (method_exists($bodyObject, 'getRawContent')) {
            $body = $bodyObject->getRawContent();
            $to = implode(',', $message->getRecipients());
            $from = $message->getFrom();
        } else {
            $body = 'could not retrieve body';
            $to = 'could not retrieve recipients';
            $from = 'could not retrieve from address';
        }

        $subject = mb_decode_mimeheader($message->getSubject());
        $this->setBody($body);
        $this->setSubject($subject);
        $this->setTo($to);
        $this->setFrom($from);
        $this->setCreatedAt(date('c'));
        $this->save();
    }

    public function getEmailAddressesFromObject($addresses, $asString = true)
    {
        $emailAddresses = [];
        foreach ($addresses as $address) {
            $emailAddresses[] = $address->getEmail();
        }

        if ($asString) {
            return implode(',', $emailAddresses);
        }

        return $emailAddresses;
    }
}


