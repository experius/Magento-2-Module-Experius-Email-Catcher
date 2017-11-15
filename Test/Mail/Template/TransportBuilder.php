<?php
/**
 * Mail Template Transport Builder
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Experius\EmailCatcher\Test\Mail\Template;

use Magento\Framework\App\TemplateTypesInterface;
use Magento\Framework\Mail\MessageInterface;
use Experius\EmailCatcher\Test\Mail\TransportInterfaceFactory;
use Magento\Framework\ObjectManagerInterface;

/**
 * @api
 */
class TransportBuilder extends \Magento\Framework\Mail\Template\TransportBuilder
{
    /**
     * Template Identifier
     *
     * @var string
     */
    protected $templateIdentifier;

    /**
     * Template Model
     *
     * @var string
     */
    protected $templateModel;

    /**
     * Template Variables
     *
     * @var array
     */
    protected $templateVars;

    /**
     * Template Options
     *
     * @var array
     */
    protected $templateOptions;

    /**
     * Mail Transport
     *
     * @var \Magento\Framework\Mail\TransportInterface
     */
    protected $transport;

    /**
     * Template Factory
     *
     * @var FactoryInterface
     */
    protected $templateFactory;

    /**
     * Object Manager
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Message
     *
     * @var \Magento\Framework\Mail\Message
     */
    protected $message;

    /**
     * Sender resolver
     *
     * @var \Magento\Framework\Mail\Template\SenderResolverInterface
     */
    protected $_senderResolver;

    /**
     * @var \Magento\Framework\Mail\TransportInterfaceFactory
     */
    protected $mailTransportFactory;

    /**
     * @param FactoryInterface $templateFactory
     * @param MessageInterface $message
     * @param SenderResolverInterface $senderResolver
     * @param ObjectManagerInterface $objectManager
     * @param TransportInterfaceFactory $mailTransportFactory
     */
    public function __construct(
        \Magento\Framework\Mail\Template\FactoryInterface $templateFactory,
        MessageInterface $message,
        \Magento\Framework\Mail\Template\SenderResolverInterface $senderResolver,
        ObjectManagerInterface $objectManager,
        TransportInterfaceFactory $mailTransportFactory
    ) {
        $this->templateFactory = $templateFactory;
        $this->message = $message;
        $this->objectManager = $objectManager;
        $this->_senderResolver = $senderResolver;
        $this->mailTransportFactory = $mailTransportFactory;
    }
}
