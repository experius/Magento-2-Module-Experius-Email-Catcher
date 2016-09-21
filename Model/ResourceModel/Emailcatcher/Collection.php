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

namespace Experius\EmailCatcher\Model\ResourceModel\Emailcatcher;
 
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {


	
	protected function _construct(){
		$this->_init(
		  'Experius\EmailCatcher\Model\Emailcatcher',
		  'Experius\EmailCatcher\Model\ResourceModel\Emailcatcher');
	}
}
