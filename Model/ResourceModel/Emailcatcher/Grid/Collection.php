<?php
/**
 * Copyright © Experius B.V. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Experius\EmailCatcher\Model\ResourceModel\Emailcatcher\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\Exception\AlreadyExistsException;

class Collection extends SearchResult
{
    /**
     * @inheritDoc
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            'experius_emailcatcher',
            \Experius\EmailCatcher\Model\ResourceModel\Emailcatcher\Collection::class
        );
    }

    /**
     * Add item
     *
     * @param DataObject $item
     * @return $this
     * @throws AlreadyExistsException
     */
    public function addItem(DataObject $item)
    {
        $itemId = $this->_getItemId($item);

        if (isset($item['body'])) {
            unset($item['body']);
        }

        if ($itemId !== null) {
            if (isset($this->_items[$itemId])) {
                throw new AlreadyExistsException(
                    __('Item (' . get_class($item) . ') with the same ID "' . $item->getId() . '" already exists.')
                );
            }
            $this->_items[$itemId] = $item;
        } else {
            $this->_addItem($item);
        }
        return $this;
    }
}
