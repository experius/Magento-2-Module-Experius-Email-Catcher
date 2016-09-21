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
 
 
class Index extends \Magento\Backend\App\Action {

	protected $resultPageFactory;

	protected $_emailCatcher;	
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Experius\EmailCatcher\Model\EmailcatcherFactory $emailCatcher
	){
		
		$this->resultPageFactory = $resultPageFactory;
		
		$this->_emailCatcher = $emailCatcher;
		
		parent::__construct($context);
	}

	
	public function execute(){
		
		$id = $this->getRequest()->getParam('emailcatcher_id');
        if($id){
            
            $model = $this->_emailCatcher->create();
            $email = $model->load($id);
                        
            echo $email->getBody();
		}
	}
}
