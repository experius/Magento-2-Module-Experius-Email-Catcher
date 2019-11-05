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

use Magento\Framework\App\Config\ScopeConfigInterface;

class TransportInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Experius\EmailCatcher\Model\EmailcatcherFactory
     */
    private $emailCatcher;

    /**
     * TransportInterface constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->emailCatcher = $emailCatcher;
    }

    /**
     * Around sendMessage plugin
     *
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     * @throws \ReflectionException
     */
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

        /**
         * @TODO: halt send message if whitelist feature is enabled, and template is not part of whitelisted templates.
         * getTemplateIdentifier() is now possible on subject to check the template.
         */
        $proceed();
    }
}
