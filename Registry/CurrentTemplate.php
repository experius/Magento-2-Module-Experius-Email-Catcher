<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
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
