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

    protected $magentoProductMetaData;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        \Magento\Framework\App\ProductMetadataInterface $magentoProductMetaData,
        array $data = []
    ) {
        $this->magentoProductMetaData = $magentoProductMetaData;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('Experius\EmailCatcher\Model\ResourceModel\Emailcatcher');
    }

    public function saveMessage($message)
    {
        $bodyObject  = $message->getBody();

        if (!method_exists($bodyObject, 'getRawContent') && method_exists($message, 'getRawMessage')) {
            $zendMessageObject = new \Zend\Mail\Message();
            $zendMessage = $zendMessageObject::fromString($message->getRawMessage());
            $body = $zendMessage->getBodyText();
            if (version_compare($this->magentoProductMetaData->getVersion(), "2.3.3", ">=")) {
                $body = quoted_printable_decode($body);
            }
            $recipient = $this->getEmailAddressesFromObject($zendMessage->getTo());
            $sender = $this->getEmailAddressesFromObject($zendMessage->getFrom());
        } elseif (method_exists($bodyObject, 'getRawContent')) {
            $body = $bodyObject->getRawContent();
            $recipient = implode(',', $message->getRecipients());
            $sender = $message->getFrom();
        } else {
            $body = 'could not retrieve body';
            $recipient = 'could not retrieve recipients';
            $sender = 'could not retrieve from address';
        }

        $subject = mb_decode_mimeheader($message->getSubject());
        $this->setBody($body);
        $this->setSubject($subject);
        $this->setRecipient($recipient);
        $this->setSender($sender);
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
