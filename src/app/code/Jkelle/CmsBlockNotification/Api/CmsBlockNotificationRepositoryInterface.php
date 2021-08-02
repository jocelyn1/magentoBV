<?php

namespace Jkelle\CmsBlockNotification\Api;

use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CmsBlockNotificationRepositoryInterface
 * @package Jkelle\CmsBlockNotification\Api
 */
interface CmsBlockNotificationRepositoryInterface
{
    /**
     * @param array $data
     * @return CmsBlockNotificationInterface
     */
    public function create(array $data = []): CmsBlockNotificationInterface;

    /**
     * @param $value
     * @param string|null $field
     * @return CmsBlockNotificationInterface
     */
    public function get($value, string $field = null): CmsBlockNotificationInterface;

    /**
     * @param int $id
     * @return CmsBlockNotificationInterface
     */
    public function getId(int $id): CmsBlockNotificationInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CmsBlockNotificationSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CmsBlockNotificationSearchResultsInterface;

    /**
     * @param array $criteria
     * @param array $orders
     * @param int|null $limit
     * @return CmsBlockNotificationSearchResultsInterface
     */
    public function findBy(array $criteria, array $orders = [], int $limit = null): CmsBlockNotificationSearchResultsInterface;

    /**
     * @param array $criteria
     * @return CmsBlockNotificationInterface|null
     */
    public function findOneBy(array $criteria): ?CmsBlockNotificationInterface;

    /**
     * @return CmsBlockNotificationSearchResultsInterface
     */
    public function findAll(): CmsBlockNotificationSearchResultsInterface;

    /**
     * @param CmsBlockNotificationInterface $entity
     */
    public function save(CmsBlockNotificationInterface $entity): void;

    /**
     * @param CmsBlockNotificationInterface $entity
     */
    public function delete(CmsBlockNotificationInterface $entity): void;
}
