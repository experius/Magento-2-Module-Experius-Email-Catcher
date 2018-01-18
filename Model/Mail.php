<?php

namespace Experius\EmailCatcher\Model;

class Mail
{

    protected $messageFactory;

    protected $emailCatcherFactory;

    protected $transport;

    public function __construct(
        \Magento\Framework\Mail\Message $messageFactory,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailcatcherFactory,
        \Experius\EmailCatcher\Mail\Transport $transport
    ) {
        $this->messageFactory = $messageFactory;
        $this->emailCatcherFactory = $emailcatcherFactory;
        $this->transport = $transport;
    }

    public function sendMessage($emailCatcherId, $alternativeToAddress)
    {

        /* @var $emailCatcher \Experius\EmailCatcher\Model\Emailcatcher */
        $emailCatcher = $this->emailCatcherFactory->create()->load($emailCatcherId);

        /* @var $message \Magento\Framework\Mail\Message */
        $message = $this->messageFactory;

        $to = ($alternativeToAddress) ? $alternativeToAddress : $emailCatcher->getTo();

        $message->setMessageType('html');
        $message->setFrom($emailCatcher->getFrom());
        $message->addTo($to);
        $message->setBodyHtml($emailCatcher->getBody());
        $message->setSubject(mb_encode_mimeheader($emailCatcher->getSubject()));

        $this->transport->setMessage($message);
        $this->transport->sendMessage();
    }
}
