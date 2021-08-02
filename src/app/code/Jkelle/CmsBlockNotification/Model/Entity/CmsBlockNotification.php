<?php

namespace Jkelle\CmsBlockNotification\Model\Entity;

use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class CmsBlockNotification
 * @package Jkelle\CmsBlockNotification\Model
 */
class CmsBlockNotification extends AbstractModel implements CmsBlockNotificationInterface
{
    /**
     * Event prefix in events.xml file
     * EX: jkelle_cms_block_notification_load_after Voir dans AbstractModel.php l'event
     * @var string
     */
    protected $_eventPrefix = 'jkelle_cms_block_notification';

    /**
     * Param name in event
     * In Observer $observer->getEvent()->getJkelleCmsBlockNotification()
     * @var string
     */
    protected $_eventObject = 'jkelle_cms_block_notification';


    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getBlockId(): int
    {
        return $this->getData(self::BLOCK_ID);
    }

    /**
     * @inheritDoc
     */
    public function setBlockId(int $blockId): void
    {
        $this->setData(self::BLOCK_ID, $blockId);
    }

    /**
     * @inheritDoc
     */
    public function getBeginAt(): string
    {
        return $this->getData(self::BEGIN_AT);
    }

    /**
     * @inheritDoc
     */
    public function setBeginAt(string $beginAt): void
    {
        $this->setData(self::BEGIN_AT, $beginAt);
    }

    /**
     * @inheritDoc
     */
    public function getBeginEnd(): string
    {
        return $this->getData(self::END_AT);
    }

    /**
     * @inheritDoc
     */
    public function setBeginEnd(string $beginEnd): void
    {
        $this->setData(self::END_AT, $beginEnd);
    }
}
