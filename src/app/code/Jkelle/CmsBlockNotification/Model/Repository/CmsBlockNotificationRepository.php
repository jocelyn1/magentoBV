<?php

namespace Jkelle\CmsBlockNotification\Model\Repository;

use Exception;
use Jkelle\CmsBlockNotification\Api\CmsBlockNotificationRepositoryInterface;
use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationSearchResultsInterface;
use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotificationFactory;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification as ResourceModel;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification\CollectionFactory;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification\CmsBlockNotificationSearchResultsFactory;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Model\AbstractModel;
use Psr\Log\LoggerInterface;

/**
 * Class CmsBlockNotificationRepository
 * @package Jkelle\CmsBlockNotification\Model\Repository
 */
class CmsBlockNotificationRepository implements CmsBlockNotificationRepositoryInterface
{
    /** @var CmsBlockNotificationFactory */
    private $factory;

    /** @var ResourceModel */
    private $resourceModel;

    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var FilterGroupBuilder */
    private $filterGroupBuilder;

    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var CmsBlockNotificationSearchResultsFactory */
    private $searchResultsFactory;

    /** @var CollectionProcessorInterface */
    private $collectionProcessor;

    /** @var LoggerInterface */
    private $logger;

    /**
     * CmsBlockNotificationRepository constructor.
     * @param CmsBlockNotificationFactory $factory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CmsBlockNotificationSearchResultsFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        CmsBlockNotificationFactory $factory,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory,
        FilterGroupBuilder $filterGroupBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CmsBlockNotificationSearchResultsFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    )
    {
        $this->factory = $factory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data = []): CmsBlockNotificationInterface
    {
        $entity = $this->factory->create();

        if ($entity instanceof AbstractModel) {
            $entity->addData($data);
        }

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function get($value, string $field = null): CmsBlockNotificationInterface
    {
        $entity = $this->create();

        $this->resourceModel->load($entity, $value, $field);

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function getId(int $id): CmsBlockNotificationInterface
    {
        return $this->get($id, CmsBlockNotificationInterface::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CmsBlockNotificationSearchResultsInterface
    {
       $searchResults = $this->searchResultsFactory->create();

       $searchResults->setSearchCriteria($searchCriteria);

       $collection = $this->collectionFactory->create();

       $this->collectionProcessor->process($searchCriteria, $collection);

       $searchResults->setTotalCount($collection->getSize());

       $items = [];

       foreach ($collection->getItems() as $item) {
           $items[] = $item;
       }

       $searchResults->setItems($items);

       return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orders = [], int $limit = null): CmsBlockNotificationSearchResultsInterface
    {
        $filterGroups = [];

        foreach ($criteria as $element) {
            if ($element instanceof Filter) {
                $filterGroups[] = $this->filterGroupBuilder
                    ->addFilter($element)
                    ->create();
            }
        }

        $sortOrders = [];

        foreach ($orders as $element) {
            if ($element instanceof SortOrder) {
                $sortOrders[] = $element;
            }
        }

        $searchCriteria = $this
            ->searchCriteriaBuilder
            ->setFilterGroups($filterGroups)
            ->setSortOrders($sortOrders)
            ->setPageSize($limit)
            ->create();

        return $this->getList($searchCriteria);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria): ?CmsBlockNotificationInterface
    {
        $filterGroups = [];

        foreach ($criteria as $element) {
            if ($element instanceof Filter) {
                $filterGroups[] = $this->filterGroupBuilder
                    ->addFilter($element)
                    ->create();
            }
        }

        $searchCriteria = $this
            ->searchCriteriaBuilder
            ->setFilterGroups($filterGroups)
            ->setPageSize(1)
            ->create();

        $searchResults = $this->getList($searchCriteria);

        return $searchResults->getTotalCount()
            ? current($searchResults->getItems())
            : null;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): CmsBlockNotificationSearchResultsInterface
    {
        return $this->getList(
            $this->searchCriteriaBuilder->create()
        );
    }

    /**
     * @inheritDoc
     */
    public function save(CmsBlockNotificationInterface $entity): void
    {
        try {
            if ($entity instanceof AbstractModel) {
                $this->resourceModel->save($entity);
            }
        } catch (Exception $e) {
//            var_dump($e->getMessage());die;
            $this->logger->error($e->getMessage(), [
                'exception' => $e
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(CmsBlockNotificationInterface $entity): void
    {
        try {
            if ($entity instanceof AbstractModel) {
                $this->resourceModel->delete($entity);
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage(), [
                'exception' => $e
            ]);
        }
    }
}
