<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Experius\EmailCatcher\Registry\CurrentTemplate;

class Emailcatcher extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'experius_email_catcher';

    /**
     * @var string
     */
    protected $_eventObject = 'email';

    /**
     * @param Context $context
     * @param Registry $registry
     * @param CurrentTemplate $currentTemplate
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        protected CurrentTemplate $currentTemplate,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\Experius\EmailCatcher\Model\ResourceModel\Emailcatcher::class);
    }

    /**
     * Save message
     *
     * @param $message
     */
    public function saveMessage($message)
    {
        $bodyObject = $message->getBody();

        if (!method_exists($bodyObject, 'getRawContent') && method_exists($message, 'getRawMessage')) {
            $zendMessageObject = new \Laminas\Mail\Message();
            $zendMessage = $zendMessageObject::fromString($message->getRawMessage());
            $body = $zendMessage->getBodyText();
            $body = quoted_printable_decode($body);
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

        $templateIdentifier = $this->currentTemplate->get();
        $subject = $this->imapUtf8($message->getSubject());
        $this->setBody($body);
        $this->setSubject($subject);
        $this->setRecipient($recipient);
        $this->setSender($sender);
        $this->setCreatedAt(date('c'));
        $this->setTemplateIdentifier($templateIdentifier);
        $this->save();
    }

    /**
     * Get email addresses from address object
     *
     * @param $addresses
     * @param bool $asString
     * @return array|string
     */
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

    /**
     * @param string $string
     * @return string $string
     * @todo imap_utf8 replacement
     */
    public function imapUtf8($string)
    {
        return (function_exists('imap_utf8') && is_string($string)) ? imap_utf8($string) : $string;
    }
}
