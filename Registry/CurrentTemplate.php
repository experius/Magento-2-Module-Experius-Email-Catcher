<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Registry;

class CurrentTemplate
{
    private $templateIdentifier;

    /**
     * Set template identifier
     *
     * @param $templateIdentifier
     * @return void
     */
    public function set($templateIdentifier)
    {
        $this->templateIdentifier = $templateIdentifier;
    }

    /**
     * Get template identifier
     *
     * @return mixed
     */
    public function get()
    {
        return $this->templateIdentifier;
    }
}
