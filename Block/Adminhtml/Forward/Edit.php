<?php

namespace Experius\EmailCatcher\Block\Adminhtml\Forward;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
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
