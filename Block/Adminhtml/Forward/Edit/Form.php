<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Block\Adminhtml\Forward\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $emailCatcherId = $this->getRequest()->getParam('emailcatcher_id');

        $selected = $this->getRequest()->getParam('selected');

        $emailCatcherIds = ($emailCatcherId) ?: implode(',', $selected);

        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Forward')]);

        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'class' => 'required-entry validate-email',
                'required' => true
            ]
        );

        $fieldset->addField(
            'selected',
            'hidden',
            [
                'name' => 'selected',
                'required' => true,
                'value' => $emailCatcherIds
            ]
        );

        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/send', ['emailcatcher_id' => $emailCatcherId]));
        $form->setMethod('post');
        $this->setForm($form);
    }
}
