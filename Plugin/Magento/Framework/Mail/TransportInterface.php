<?php

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;


class TransportInterface
{
    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        \Closure $proceed
    ) {
        $proceed();
    }
}
