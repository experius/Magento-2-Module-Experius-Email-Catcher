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

        $subject = mb_decode_mimeheader($message->getSubject());

        $this->setBody($message->getBody()->getRawContent());
        $this->setSubject($subject);
        $this->setTo(implode(',', $message->getRecipients()));
        $this->setFrom($message->getFrom());
        $this->setCreatedAt(date('c'));
        $this->save();
    }
}
