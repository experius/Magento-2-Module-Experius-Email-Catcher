<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\EmailCatcher;

use Experius\EmailCatcher\Block\Adminhtml\Forward\Edit;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Forward extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        protected PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $result = $this->resultPageFactory->create();
        $result->getConfig()->getTitle()->prepend(__('Email Catcher'));
        $result->getLayout()->addBlock(
            Edit::class,
            'forward',
            'content'
        );
        return $result;
    }
}
