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

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;

use Experius\EmailCatcher\Model\EmailcatcherFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;

class TransportInterface
{
    const CONFIG_PATH_EMAIL_CATCHER_ENABLED = 'emailcatcher/general/enabled';
    const CONFIG_PATH_WHITELIST_APPLY_WHITELIST = 'emailcatcher/whitelist/apply_whitelist';
    const CONFIG_PATH_TEMPLATE_WHITELIST = 'emailcatcher/whitelist/email_templates';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var EmailcatcherFactory
     */
    private $emailCatcher;

    /**
     * TransportInterface constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param EmailcatcherFactory $emailCatcher
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EmailcatcherFactory $emailCatcher
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->emailCatcher = $emailCatcher;
    }

    /**
     * Around sendMessage plugin
     *
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     * @return \Closure $proceed|void
     */
    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        \Closure $proceed
    ) {
        if (!$this->scopeConfig->isSetFlag(self::CONFIG_PATH_EMAIL_CATCHER_ENABLED, ScopeInterface::SCOPE_STORE)) {
            return $proceed();
        }

        $this->saveMessage($subject);

        // Proceed if whitelist feature is not enabled
        if (!$this->scopeConfig->isSetFlag(self::CONFIG_PATH_WHITELIST_APPLY_WHITELIST, ScopeInterface::SCOPE_STORE)) {
            return $proceed();
        }

        // Check if template is whitelisted
        if (!empty($this->getTemplateWhitelist())) {
            if (in_array($subject->getTemplateIdentifier(), $this->getTemplateWhitelist())) {
                return $proceed();
            }
        }
    }

    /**
     * Save message
     *
     * @param $subject
     * @return void
     * @throws \ReflectionException
     */
    private function saveMessage($subject)
    {
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

    /**
     * Get whitelisted templates
     *
     * @return array
     */
    private function getTemplateWhitelist()
    {
        $templates = $this->scopeConfig->getValue(
            self::CONFIG_PATH_TEMPLATE_WHITELIST,
            ScopeInterface::SCOPE_STORE
        );

        return $templates ? explode(',', $templates) : [];
    }
}
