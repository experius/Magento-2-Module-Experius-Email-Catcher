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

namespace Experius\EmailCatcher\Block\Adminhtml\Forward;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        parent::_construct();

        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_forward';
        $this->_blockGroup = 'Experius_EmailCatcher';
        $this->buttonList->remove('reset');
        $this->buttonList->update('save', 'label', __('Send'));
    }
}
