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

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ) {}

    /**
     * @param OriginalIdentityInterface $subject
     * @param $result
     * @return bool
     */
    public function afterIsEnabled(
        OriginalIdentityInterface $subject,
                                  $result
    )
    {
        return $result && $this->scopeConfig->getValue(
            'emailcatcher/general/enabled',
            ScopeInterface::SCOPE_STORE,
            $subject->getStore()->getStoreId()
        );
    }
}
