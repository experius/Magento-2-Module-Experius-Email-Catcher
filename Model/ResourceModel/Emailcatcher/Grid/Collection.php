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

namespace Experius\EmailCatcher\Model\ResourceModel\Emailcatcher\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Psr\Log\LoggerInterface as Logger;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{

    public function __construct(EntityFactory $entityFactory, Logger $logger, FetchStrategy $fetchStrategy, EventManager $eventManager)
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, 'experius_emailcatcher', 'Experius\EmailCatcher\Model\ResourceModel\Emailcatcher\Collection');
    }


    public function addItem(\Magento\Framework\DataObject $item)
    {
        $itemId = $this->_getItemId($item);

        if (isset($item['body'])) {
            unset($item['body']);
        }

        if ($itemId !== null) {
            if (isset($this->_items[$itemId])) {
                throw new \Exception(
                    'Item (' . get_class($item) . ') with the same ID "' . $item->getId() . '" already exists.'
                );
            }
            $this->_items[$itemId] = $item;
        } else {
            $this->_addItem($item);
        }
        return $this;
    }
}
