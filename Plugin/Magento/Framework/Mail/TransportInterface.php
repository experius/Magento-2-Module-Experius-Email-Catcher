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
            $this->emailCatcher->create()->saveMessage($subject->getMessage());
        }

        $proceed();
    }
}
