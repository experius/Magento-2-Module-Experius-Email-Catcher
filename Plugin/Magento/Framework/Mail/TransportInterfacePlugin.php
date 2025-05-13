<?php

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail;

use Closure;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory as UserCollectionFactory;
use Experius\EmailCatcher\Model\Emailcatcher;

class TransportInterfacePlugin
{
    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param UserCollectionFactory $userCollectionFactory
     * @param Emailcatcher $emailcatcher
     */
    public function __construct(
        protected ScopeConfigInterface  $scopeConfig,
        protected UserCollectionFactory $userCollectionFactory,
        protected Emailcatcher          $emailcatcher
    ) {}

    /**
     * @param \Magento\Framework\Mail\TransportInterface $subject
     * @param Closure $proceed
     * @return void
     */
    public function aroundSendMessage(
        \Magento\Framework\Mail\TransportInterface $subject,
        Closure                                    $proceed
    ): void
    {
        if (!$this->scopeConfig->isSetFlag('system/smtp/disable', ScopeInterface::SCOPE_STORE)) {
            $proceed();
            return;
        }

        if ($this->emailcatcher->developmentAdminAllowedEnabled()) {
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
    }

    /**
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

    /**
     * @return array
     */
    protected function getCustomAllowedEmails(): array
    {
        $customEmails = $this->emailcatcher->getDevelopmentAdminAllowedEmailAddresses();

        return !is_array($customEmails) ? explode(',', $customEmails) : $customEmails;
    }

}