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
     * @var CurrentTemplate
     */
    private $currentTemplate;

    /**
     * TransportInterface constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param EmailcatcherFactory $emailCatcher
     * @param CurrentTemplate $currentTemplate
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EmailcatcherFactory $emailCatcher,
        CurrentTemplate $currentTemplate
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->emailCatcher = $emailCatcher;
        $this->currentTemplate = $currentTemplate;
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
        $currentTemplate = $this->currentTemplate->get();
        if (!empty($this->getTemplateWhitelist())) {
            if (in_array($currentTemplate, $this->getTemplateWhitelist())) {
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
