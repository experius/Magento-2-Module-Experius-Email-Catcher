<?php

namespace Experius\EmailCatcher\Model;

class Mail
{

    protected $messageFactory;

    protected $emailCatcherFactory;

    protected $mailTransportFactory;

    public function __construct(
        \Magento\Framework\Mail\Message $messageFactory,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailcatcherFactory,
        \Magento\Framework\Mail\TransportInterfaceFactory $transportInterfaceFactory
    ) {
        $this->messageFactory = $messageFactory;
        $this->emailCatcherFactory = $emailcatcherFactory;
        $this->mailTransportFactory = $transportInterfaceFactory;
    }

    public function sendMessage($emailCatcherId, $alternativeToAddress)
    {

        /* @var $emailCatcher \Experius\EmailCatcher\Model\Emailcatcher */
        $emailCatcher = $this->emailCatcherFactory->create()->load($emailCatcherId);

        /* @var $message \Magento\Framework\Mail\Message */
        $message = $this->messageFactory;

        $recipient = ($alternativeToAddress) ? $alternativeToAddress : $emailCatcher->getRecipient();

        $message->setMessageType('html');
        $message->setFrom($emailCatcher->getSender());
        $message->addTo($recipient);
        $message->setBodyHtml($emailCatcher->getBody());
        $message->setSubject(mb_encode_mimeheader($emailCatcher->getSubject()));

        $mailTransport = $this->mailTransportFactory->create(['message' => clone $message]);

        $mailTransport->sendMessage();
    }
}
