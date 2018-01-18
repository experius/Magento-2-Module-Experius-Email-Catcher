<?php

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;

use Magento\Framework\App\Config\ScopeConfigInterface;

class TransportInterface
{

    private $scopeConfig;

    private $emailCatcher;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->emailCatcher = $emailCatcher;
    }

    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        \Closure $proceed
    ) {

        if ($this->scopeConfig->getValue(
            'emailcatcher/general/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        )) {

            // For >= 2.2
            if (method_exists($subject, 'getMessage')) {
                $this->emailCatcher->create()->saveMessage($subject->getMessage());
            } else {
                //For < 2.2
                $reflection = new \ReflectionClass($subject);
                $property = $reflection->getProperty('_message');
                $property->setAccessible(true);
                $this->emailCatcher->create()->saveMessage($property->getValue($subject));
            }
        }

        $proceed();
    }
}
