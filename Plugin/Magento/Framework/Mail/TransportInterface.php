<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;

use Experius\EmailCatcher\Model\EmailcatcherFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;
use Experius\EmailCatcher\Registry\CurrentTemplate;
use Experius\EmailCatcher\Model\Emailcatcher;

class TransportInterface
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param EmailcatcherFactory $emailCatcherFactory
     * @param CurrentTemplate $currentTemplate
     * @param Emailcatcher $emailcatcher
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig,
        private EmailcatcherFactory $emailCatcherFactory,
        private CurrentTemplate $currentTemplate,
        private Emailcatcher $emailcatcher
    ) {}

    /**
     * Around sendMessage plugin
     *
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     * @return \Closure|void $proceed
     * @throws \ReflectionException
     */
    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        \Closure $proceed
    ) {
        if (!$this->emailcatcher->emailCatcherEnabled()) {
            return $proceed();
        }

        if ($this->emailcatcher->blackListEnabled() && in_array($this->getToEmailAddress($subject), $this->getBlacklistEmailAddresses())) {
            $subject->getMessage()->setSubject('Prevent Being Sent');
            $this->saveMessage($subject);

            return;
        }

        $this->saveMessage($subject);

        if (!$this->emailcatcher->whitelistEnabled()) {
            return $proceed();
        }

        $currentTemplate = $this->currentTemplate->get();
        if (!empty($this->getTemplateWhitelist())) {
            if (in_array($currentTemplate, $this->getTemplateWhitelist())) {
                return $proceed();
            }
        }
    }

    /**
     * @param $subject
     * @return void
     */
    private function saveMessage($subject): void
    {
        $this->emailCatcherFactory->create()->saveMessage($subject->getMessage());
    }

    /**
     * Get whitelisted templates
     * @return array
     */
    private function getTemplateWhitelist(): array
    {
        $templates = $this->scopeConfig->getValue(
            Emailcatcher::CONFIG_PATH_TEMPLATE_WHITELIST,
            ScopeInterface::SCOPE_STORE
        );

        return $templates ? explode(',', $templates) : [];
    }

    /**
     * @return array
     */
    protected function getBlacklistEmailAddresses() : array
    {
        return $this->scopeConfig->getValue('prevent_sending_email/blacklist/block_email_addresses');
    }

    /**
     * @param $subject
     * @return string
     */
    protected function getToEmailAddress($subject): string
    {
        return $subject->getMessage()->getTo()[0]->getEmail() ?? '';
    }
}
