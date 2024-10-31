<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model\Config\Source;

use Magento\Email\Model\Template\Config;
use Magento\Framework\Option\ArrayInterface;
use Magento\Email\Model\ResourceModel\Template\CollectionFactory;

class EmailTemplates implements ArrayInterface
{
    /**
     * EmailTemplates constructor.
     *
     * @param Config $templateConfig
     * @param CollectionFactory $emailTemplateCollectionFactory
     */
    public function __construct(
        protected Config $templateConfig,
        protected CollectionFactory $emailTemplateCollectionFactory
    ) {}

    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $templates = $this->templateConfig->getAvailableTemplates();
        foreach ($templates as $template) {
            $template['label'] = $template['label'] . ' (' . $template['group'] . ')';
        }

        $emailTemplateCollection = $this->emailTemplateCollectionFactory
            ->create()
            ->toOptionArray();
        foreach ($emailTemplateCollection as &$customTemplate) {
            $customTemplate['label'] = $customTemplate['label'] . ' (Custom)';
        }

        $templates = array_merge($templates, $emailTemplateCollection);
        usort($templates, function ($a, $b) {
            return $a['label'] <=> $b['label'];
        });

        return $templates;
    }
}
