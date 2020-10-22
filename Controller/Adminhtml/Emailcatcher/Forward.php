<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Controller\Adminhtml\Emailcatcher;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Forward extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Forward constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
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
            \Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::class,
            'forward',
            'content'
        );
        return $result;
    }
}
