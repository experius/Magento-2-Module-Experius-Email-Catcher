<?php

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory as UserCollectionFactory;
use Experius\EmailCatcher\Model\Emailcatcher;

class TransportInterfacePlugin
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param UserCollectionFactory $userCollectionFactory
     */
    public function __construct(
        private ScopeConfigInterface  $scopeConfig,
        private UserCollectionFactory $userCollectionFactory
    ) {}

    /**
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param \Closure $proceed
     * @return void
     */
    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        \Closure                                   $proceed
    ): void
    {
        if (!$this->scopeConfig->isSetFlag('system/smtp/disable', ScopeInterface::SCOPE_STORE) ||
            !$this->scopeConfig->isSetFlag(Emailcatcher::CONFIG_PATH_EMAIL_CATCHER_ENABLED, ScopeInterface::SCOPE_STORE) ||
            !$this->scopeConfig->isSetFlag(Emailcatcher::CONFIG_PATH_DEVELOPMENT_EMAIL_CATCHER_ADMIN_ALLOWED_ENABLED, ScopeInterface::SCOPE_STORE)
        ) {
            $proceed();
            return;
        }

        $emailAddresses = [];
        foreach ($subject->getMessage()->getTo() as $to) {
            $emailAddresses[] = $to->getEmail();
        }
        foreach ($subject->getMessage()->getCc() as $cc) {
            $emailAddresses[] = $cc->getEmail();
        }
        foreach ($subject->getMessage()->getBcc() as $bcc) {
            $emailAddresses[] = $bcc->getEmail();
        }
        if ($this->containsOnlyAdminUsers($emailAddresses)) {
            $proceed();
        }
    }

    /**
     * Addresses contains a known admin user email address
     *
     * @param $emailAddresses
     * @return bool
     */
    public function containsOnlyAdminUsers($emailAddresses): bool
    {
        $nonAdminEmailAddresses = array_diff($emailAddresses, $this->getAdminAndCustomAllowedEmails());

        return count($nonAdminEmailAddresses) === 0;
    }

    /**
     * @return array
     */
    protected function getAdminAndCustomAllowedEmails(): array
    {
        return array_merge($this->getAdminEmails(), $this->getCustomAllowedEmails());
    }

    /**
     * @return array
     */
    protected function getAdminEmails(): array
    {
        $collection = $this->userCollectionFactory->create();

        return $collection->addFieldToSelect('email')->getColumnValues('email');
    }

    protected function getCustomAllowedEmails()
    {
       return $this->scopeConfig->getValue(
            Emailcatcher::CONFIG_PATH_DEVELOPMENT_EMAIL_CATCHER_ALLOWED_ADDRESSES,
            ScopeInterface::SCOPE_STORE);
    }

}