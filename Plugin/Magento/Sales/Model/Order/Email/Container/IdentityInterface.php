<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Plugin\Magento\Sales\Model\Order\Email\Container;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Sales\Model\Order\Email\Container\IdentityInterface as OriginalIdentityInterface;
use Magento\Store\Model\ScopeInterface;

class IdentityInterface
{

    private const XML_PATH_SYSTEM_SMTP_DISABLE = 'system/smtp/disable';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    /**
     * Since ApplyStoreEmailConfigToSalesEmail plugin from Magento is disabled, partial takeover of that functionality to here.
     * @param OriginalIdentityInterface $subject
     * @param $result
     * @return bool
     */
    public function afterIsEnabled(
        OriginalIdentityInterface $subject,
                                  $result
    )
    {
        if ($result &&
            $this->scopeConfig->isSetFlag(
                self::XML_PATH_SYSTEM_SMTP_DISABLE,
                ScopeInterface::SCOPE_STORE,
                $subject->getStore()->getStoreId()
            )
        ) {
            $result = (bool)$this->scopeConfig->getValue(
                'emailcatcher/general/enabled',
                ScopeInterface::SCOPE_STORE,
                $subject->getStore()->getStoreId()
            );
        }
        return $result;
    }
}
