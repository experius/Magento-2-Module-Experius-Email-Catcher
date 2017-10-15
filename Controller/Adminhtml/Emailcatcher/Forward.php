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

namespace Experius\EmailCatcher\Controller\Adminhtml\Emailcatcher;


class Forward extends \Magento\Backend\App\Action {

    protected $resultPageFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ){
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    public function execute(){

        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->prepend(__('Email Catcher'));
        $result->getLayout()->addBlock(\Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::class, 'forward', 'content');
        return $result;
    }
}
