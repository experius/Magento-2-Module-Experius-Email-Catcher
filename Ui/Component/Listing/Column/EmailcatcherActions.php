<?php
/**
 * A Magento 2 module named Experius/EmailCatcher
 * Copyright (C) 2019 Experius
 *
 * This file included in Experius/EmailCatcher is licensed under OSL 3.0
 *
 * http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Please see LICENSE.txt for the full text of the OSL 3.0 license
 */

namespace Experius\EmailCatcher\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class EmailcatcherActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_PATH_EDIT = 'experius_emailcatcher/preview/index';
    const URL_PATH_DELETE = 'experius_emailcatcher/emailcatcher/delete';
    const URL_PATH_DETAILS = 'experius_emailcatcher/emailcatcher/details';
    const URL_PATH_SEND = 'experius_emailcatcher/emailcatcher/send';
    const URL_PATH_FORWARD = 'experius_emailcatcher/emailcatcher/forward';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * EmailcatcherActions constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['emailcatcher_id'])) {
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'emailcatcher_id' => $item['emailcatcher_id']
                                ]
                            ),
                            'label' => __('View'),
                            'popup' => true
                        ],
                        'resend' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_SEND,
                                [
                                    'emailcatcher_id' => $item['emailcatcher_id']
                                ]
                            ),
                            'label' => __('Resend'),
                            'confirm' => [
                                'title' => __('Resend email to "${ $.$data.recipient }"'),
                                'message' => __('Are you sure you wan\'t resend this email to "${ $.$data.recipient }"?')
                            ]
                        ],
                        'forward' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_FORWARD,
                                [
                                    'emailcatcher_id' => $item['emailcatcher_id']
                                ]
                            ),
                            'label' => __('Forward')
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}
