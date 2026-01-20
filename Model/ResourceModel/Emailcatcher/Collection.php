<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model\ResourceModel\Emailcatcher;

use Experius\EmailCatcher\Model\Emailcatcher;
use Experius\EmailCatcher\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            Emailcatcher::class,
            ResourceModel\Emailcatcher::class
        );
    }
}
