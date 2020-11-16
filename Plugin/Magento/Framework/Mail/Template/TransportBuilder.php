<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
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
