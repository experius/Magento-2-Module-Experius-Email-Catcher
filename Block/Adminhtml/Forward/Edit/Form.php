<?php

namespace Experius\EmailCatcher\Block\Adminhtml\Forward\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $emailCatcherId = $this->getRequest()->getParam('emailcatcher_id');

        $emailCatcherIds = ($emailCatcherId) ? $emailCatcherId : implode(',',$this->getRequest()->getParam('selected'));

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
                'value'=> $emailCatcherIds
            ]
        );

        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/send',['emailcatcher_id'=>$this->getRequest()->getParam('emailcatcher_id')]));
        $form->setMethod('post');
        $this->setForm($form);
    }
}
