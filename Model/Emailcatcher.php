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

namespace Experius\EmailCatcher\Model;

use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

class Emailcatcher extends \Magento\Framework\Model\AbstractModel
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
     * @var ProductMetadataInterface|null
     */
    protected $magentoProductMetaData;

    /**
     * Emailcatcher constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param ProductMetadataInterface $magentoProductMetaData
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ProductMetadataInterface $magentoProductMetaData = null,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);

        $this->magentoProductMetaData = $magentoProductMetaData ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->get(ProductMetadataInterface::class);
    }

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('Experius\EmailCatcher\Model\ResourceModel\Emailcatcher');
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
            $body = $message->getBodyText();
            if (version_compare($this->magentoProductMetaData->getVersion(), "2.3.3", ">=")) {
                $body = quoted_printable_decode($body);
            }
            $recipient = $this->getEmailAddressesFromObject($message->getTo());
            $sender = $this->getEmailAddressesFromObject($message->getFrom());
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
}
