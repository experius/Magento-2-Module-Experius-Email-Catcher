<?php

/**
 * A Magento 2 module named Experius/EmailCatcher
 * Copyright (C) 2016 Derrick Heesbeen
 *
 * This file included in Experius/EmailCatcher is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Experius\EmailCatcher\Model\Config\Source;

class EmailTemplates implements \Magento\Framework\Option\ArrayInterface
{
    protected $templateConfig;

    public function __construct(
        \Magento\Email\Model\Template\Config $templateConfig
    )
    {
        $this->templateConfig = $templateConfig;
    }

    public function toOptionArray()
    {
        $templates = $this->templateConfig->getAvailableTemplates();

        foreach ($templates as $template){
            $template['label'] = $template['label'] . ' (' . $template['group'] . ')';
        }
        usort($templates, function($a, $b) {
            return $a['label'] <=> $b['label'];
        });

        return $templates;
    }
}