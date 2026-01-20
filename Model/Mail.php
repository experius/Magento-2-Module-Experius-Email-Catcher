<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model;

use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\AddressConverter;
use Magento\Framework\Mail\EmailMessageInterfaceFactory;
use Magento\Framework\Mail\MimeMessageInterfaceFactory;
use Magento\Framework\Mail\MimePartInterfaceFactory;
use Experius\EmailCatcher\Registry\CurrentTemplate;
use Magento\Framework\Mail\TransportInterfaceFactory;

class Mail
{
    /**
     * Param that used for storing all message data until it will be used
     *
     * @var array
     */
    private array $messageData = [];

    /**
     * @param EmailcatcherFactory $emailCatcherFactory
     * @param CurrentTemplate $currentTemplate
     * @param EmailMessageInterfaceFactory $emailMessageInterfaceFactory
     * @param AddressConverter $addressConverter
     * @param MimePartInterfaceFactory $mimePartInterfaceFactory
     * @param MimeMessageInterfaceFactory $mimeMessageInterfaceFactory
     * @param TransportInterfaceFactory $transportFactory
     */
    public function __construct(
        protected EmailcatcherFactory $emailCatcherFactory,
        protected CurrentTemplate $currentTemplate,
        protected EmailMessageInterfaceFactory $emailMessageInterfaceFactory,
        protected AddressConverter $addressConverter,
        protected MimePartInterfaceFactory $mimePartInterfaceFactory,
        protected MimeMessageInterfaceFactory $mimeMessageInterfaceFactory,
        protected TransportInterfaceFactory $transportFactory
    ) {}

    /**
     * Send message
     *
     * @param $emailCatcherId
     * @param $alternativeToAddress
     * @throws MailException
     */
    public function sendMessage($emailCatcherId, $alternativeToAddress)
    {
        /** @var Emailcatcher $emailCatcher */
        $emailCatcher = $this->emailCatcherFactory->create()->load($emailCatcherId);
        $templateIdentifier = $emailCatcher->getTemplateIdentifier();
        if ($templateIdentifier) {
            $this->currentTemplate->set($templateIdentifier);
        }
        $recipient = $alternativeToAddress ?: $emailCatcher->getRecipient();

        // default message type is MimeInterface::TYPE_HTML, so no need to set it
        $this->messageData['from'][] = $this->addressConverter->convert(
            mb_decode_mimeheader($emailCatcher->getSender()),
            mb_decode_mimeheader($emailCatcher->getSender())
        );
        $this->messageData['to'][] = $this->addressConverter->convert(mb_decode_mimeheader($recipient), mb_decode_mimeheader($recipient));
        $content = $emailCatcher->getBody();
        $mimePart = $this->mimePartInterfaceFactory->create(['content' => $content]);
        $this->messageData['body'] = $this->mimeMessageInterfaceFactory->create(
            ['parts' => [$mimePart]]
        );
        $this->messageData['subject'] = html_entity_decode(
            (string)$emailCatcher->getSubject(),
            ENT_QUOTES
        );
        $message = $this->emailMessageInterfaceFactory->create($this->messageData);

        $mailTransport = $this->transportFactory->create(['message' => clone $message]);
        $mailTransport->sendMessage();
    }
}
