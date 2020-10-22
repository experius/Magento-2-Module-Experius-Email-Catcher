<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\Preview;

use Experius\EmailCatcher\Model\EmailcatcherFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var EmailcatcherFactory
     */
    protected $emailCatcher;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param EmailcatcherFactory $emailCatcher
     */
    public function __construct(
        Context $context,
        RawFactory $resultRawFactory,
        EmailcatcherFactory $emailCatcher
    ) {

        $this->resultRawFactory = $resultRawFactory;
        $this->emailCatcher = $emailCatcher;

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
