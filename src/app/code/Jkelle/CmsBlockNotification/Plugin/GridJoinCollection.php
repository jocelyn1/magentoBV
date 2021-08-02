<?php

namespace Jkelle\CmsBlockNotification\Plugin;

use Magento\Framework\Data\Collection;
use Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory;

/**
 * Class GridJoinCollection
 * @package Jkelle\CmsBlockNotification\Plugin
 */
class GridJoinCollection
{
    /**
     * @param CollectionFactory $subject
     * @param Collection $collection
     * @param string $requestName
     *
     * @return Collection
     */
    public function afterGetReport(CollectionFactory $subject, Collection $collection, string $requestName)
    {
        if ($requestName == 'notification_listing_data_source') {
            $select = $collection->getSelect();
            $select->joinLeft(
                ["cmsBlock" => $collection->getTable("cms_block")],
                'main_table.block_id = cmsBlock.block_id',
                ['is_active']
            );
        }

//        aucun rapport avec cms_block c'est jsute pour tester, mais surement pas la bonne methode (a voir)
        if ($requestName == 'sales_order_grid_data_source') {
            $select = $collection->getSelect();
            $select->joinLeft(
                ["cmsBlock" => $collection->getTable("cms_block")],
                'main_table.entity_id = cmsBlock.block_id',
                ['is_active']
            );
        }

//        var_dump($select->__toString());die;
        return $collection;
    }
}
