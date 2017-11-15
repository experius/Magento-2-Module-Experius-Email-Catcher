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

namespace Experius\EmailCatcher\Controller\Adminhtml\Preview;

class Index extends \Magento\Backend\App\Action
{

    protected $resultRawFactory;

    protected $emailCatcher;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
    ) {

        $this->resultRawFactory = $resultRawFactory;
        $this->emailCatcher = $emailCatcher;

        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('emailcatcher_id');
        if ($id) {
            $model = $this->emailCatcher->create();
            $email = $model->load($id);
            $resultRaw = $this->resultRawFactory->create();
            return $resultRaw->setContents($email->getBody());
        }
    }
}
