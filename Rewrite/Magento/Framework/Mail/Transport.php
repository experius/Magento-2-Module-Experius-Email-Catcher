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

namespace Experius\EmailCatcher\Rewrite\Magento\Framework\Mail;

class Transport extends \Magento\Framework\Mail\Transport
    implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var string
     */
    protected $templateIdentifier;

    /**
     * Get template identifier
     *
     * @return string
     */
    public function getTemplateIdentifier()
    {
        return $this->templateIdentifier;
    }

    /**
     * Set template identifier
     *
     * @param $templateIdentifier
     */
    public function setTemplateIdentifier($templateIdentifier)
    {
        $this->templateIdentifier = $templateIdentifier;
    }
}
