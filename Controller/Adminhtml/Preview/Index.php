<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\Preview;

use Experius\EmailCatcher\Model\EmailcatcherFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class Index extends Action
{
    /**
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param EmailcatcherFactory $emailCatcher
     */
    public function __construct(
        Context $context,
        protected RawFactory $resultRawFactory,
        protected EmailcatcherFactory $emailCatcher
    ) {
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('emailcatcher_id');
        if ($id) {
            $model = $this->emailCatcher->create();
            $email = $model->load($id);
            $body = $email->getBody();
        } else {
            $body = '<h2>' . __('Something went wrong with rendering the email, please try again') . '</h2>';
        }
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents($body);
    }
}
