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

namespace Experius\EmailCatcher\Rewrite\Magento\Framework\Mail\Template;

class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * Make template identifier public
     *
     * @var string
     */
    public $templateIdentifier;

    /**
     * Save
     *
     * @inheritDoc
     */
    public function getTransport()
    {
        $templateIdentifier = $this->templateIdentifier;
        $mailTransport = parent::getTransport();

        // Set template identifier on transport to filter on sendMessage
        $mailTransport->setTemplateIdentifier($templateIdentifier);

        return $mailTransport;
    }
}
