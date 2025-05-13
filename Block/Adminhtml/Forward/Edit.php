<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Block\Adminhtml\Forward;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
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
