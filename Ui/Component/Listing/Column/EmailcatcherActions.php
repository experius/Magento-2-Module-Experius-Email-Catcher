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

namespace Experius\EmailCatcher\Ui\Component\Listing\Column;
 
 
class EmailcatcherActions extends \Magento\Ui\Component\Listing\Columns\Column {

	const URL_PATH_EDIT = 'experius_emailcatcher/preview/index';
	const URL_PATH_DELETE = 'experius_emailcatcher/emailcatcher/delete';
	const URL_PATH_DETAILS = 'experius_emailcatcher/emailcatcher/details';
	protected $urlBuilder;

	
	public function __construct(
		\Magento\Framework\View\Element\UiComponent\ContextInterface $context,
		\Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
		\Magento\Framework\UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	){
		$this->urlBuilder = $urlBuilder;
		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	
	public function prepareDataSource(array $dataSource){
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
		                'label' => __('view test'),
						'callback' => "window.open(this.href,'_blank','width=800,height=700,resizable=1,scrollbars=1');return false;",
						'confirm'=> ['title'=>'test','message'=>'test']
		            ]
		        ];
		    }
		}
		}
		
		return $dataSource;
	}
}
