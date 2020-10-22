<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model\ResourceModel\Emailcatcher;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Experius\EmailCatcher\Model\Emailcatcher::class,
            \Experius\EmailCatcher\Model\ResourceModel\Emailcatcher::class
        );
    }
}
