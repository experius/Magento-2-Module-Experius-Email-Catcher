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

namespace Experius\EmailCatcher\Plugin\Magento\Framework\Mail\Template;

class TransportBuilder
{

    /**
     * @var \Experius\EmailCatcher\Registry\CurrentTemplate
     */
    private $currentTemplate;

    /**
     * TransportBuilder constructor.
     * @param \Experius\EmailCatcher\Registry\CurrentTemplate $currentTemplate
     */
    public function __construct(
        \Experius\EmailCatcher\Registry\CurrentTemplate $currentTemplate
    ) {
        $this->currentTemplate = $currentTemplate;
    }

    /**
     * @param \Magento\Framework\Mail\Template\TransportBuilder $subject
     * @param $result
     * @param $templateIdentifier
     * @return mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSetTemplateIdentifier(
        \Magento\Framework\Mail\Template\TransportBuilder $subject,
        $result,
        $templateIdentifier
    ) {
        $this->currentTemplate->set($templateIdentifier);
        return $result;
    }
}
