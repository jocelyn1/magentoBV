<?php

namespace Jkelle\CmsBlockNotification\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CmsBlockNotificationSearchResultsInterface
 * @package Jkelle\CmsBlockNotification\Api\Data
 */
interface CmsBlockNotificationSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return CmsBlockNotificationInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param CmsBlockNotificationInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
