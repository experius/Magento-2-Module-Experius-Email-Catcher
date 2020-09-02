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
declare(strict_types=1);

namespace Experius\EmailCatcher\Registry;

/**
 * Class CurrentTemplate
 * @package Experius\EmailCatcher\Registry
 */
class CurrentTemplate
{
    private $templateIdentifier;

    public function set($templateIdentifier)
    {
        $this->templateIdentifier = $templateIdentifier;
    }

    public function get()
    {
        return $this->templateIdentifier;
    }
}
