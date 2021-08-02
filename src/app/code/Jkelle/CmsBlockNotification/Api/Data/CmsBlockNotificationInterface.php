<?php

namespace Jkelle\CmsBlockNotification\Api\Data;

/**
 * Interface CmsBlockNotificationInterface
 * @package Jkelle\CmsBlockNotification\Api\Data
 */
interface CmsBlockNotificationInterface
{
    /** @var string */
    const ENTITY_ID = 'entity_id';
    /** @var string */
    const BLOCK_ID = 'block_id';
    /** @var string */
    const BEGIN_AT = 'begin_at';
    /** @var string */
    const END_AT = 'end_at';

    /**
     * implementé par l'abstractModel
     * @return int|null
     */
    public function getId();

    /**
     * implementé par l'abstractModel
     * @param $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getBlockId(): int;

    /**
     * @param int $blockId
     */
    public function setBlockId(int $blockId): void;

    /**
     * @return string
     */
    public function getBeginAt(): string;

    /**
     * @param string $beginAt
     */
    public function setBeginAt(string $beginAt): void;

    /**
     * @return string
     */
    public function getBeginEnd(): string;

    /**
     * @param string $beginEnd
     */
    public function setBeginEnd(string $beginEnd): void;
}
