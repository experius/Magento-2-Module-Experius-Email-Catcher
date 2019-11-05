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

namespace Experius\EmailCatcher\Model\Config\Source;

use Magento\Email\Model\Template\Config;
use Magento\Framework\Option\ArrayInterface;

class EmailTemplates implements ArrayInterface
{
    /**
     * @var Config
     */
    protected $templateConfig;

    /**
     * EmailTemplates constructor.
     *
     * @param Config $templateConfig
     */
    public function __construct(
        Config $templateConfig
    ) {
        $this->templateConfig = $templateConfig;
    }

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
        usort($templates, function ($a, $b) {
            return $a['label'] <=> $b['label'];
        });

        return $templates;
    }
}
