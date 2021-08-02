<?php

namespace Jkelle\CmsBlockNotification\Ui\Component\DataProvider;

use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotification;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification\Collection;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class CmsBlockNotificationDataProvider
 * @package Jkelle\CmsBlockNotification\Ui\Component\DataProvider
 */
class CmsBlockNotificationDataProvider extends AbstractDataProvider
{
    /** @var Collection */
    protected $collection;

    /** @var DataPersistorInterface */
    protected $dataPersistor;

    /** @var array */
    protected $loadedData;

    /**
     * CmsBlockNotificationDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Collection $collection
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        Collection $collection,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collection;
        $this->dataPersistor = $dataPersistor;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $select = $this->collection->getSelect();
        $select->joinLeft(
            ["cmsBlock" => $this->collection->getTable("cms_block")],
            'main_table.entity_id = cmsBlock.block_id',
            ['is_active']
        );

//        var_dump($this->collection->getSelect()->__toString());die;
        $items = $this->collection->getItems();
        /** @var CmsBlockNotification $block */
        foreach ($items as $block) {
            $result['notification'] = $block->getData();
//            $this->loadedData[$block->getId()] = $block->getData();
            $this->loadedData[$block->getId()] = $result;
        }

        $data = $this->dataPersistor->get('jkelle_cmsblocknotification');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('jkelle_cmsblocknotification');
        }
//        var_dump($this->loadedData);die;

        return $this->loadedData;
    }
}
