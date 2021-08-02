<?php

namespace Jkelle\CmsBlockNotification\Model\ResourceModel;

use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CmsBlockNotification
 * @package Jkelle\CmsBlockNotification\Model\ResourceModel
 */
class CmsBlockNotification extends AbstractDb
{
    /** @var string */
    const TABLE_NAME = 'cms_block_notification';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, CmsBlockNotificationInterface::ENTITY_ID);
    }
}
