<?php

namespace Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification;

use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotification as Model;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification
 */
class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }

}
