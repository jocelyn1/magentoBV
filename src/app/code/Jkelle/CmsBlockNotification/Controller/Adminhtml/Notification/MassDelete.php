<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Jkelle\CmsBlockNotification\Model\ResourceModel\CmsBlockNotification\CollectionFactory;
use Jkelle\CmsBlockNotification\Api\CmsBlockNotificationRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class MassDelete
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification
 */
class MassDelete extends Action
{
    /** @var string */
    const ADMIN_RESOURCE = 'Jkelle_CmsBlockNotification::notification';

    /**
    * @var CollectionFactory
    */
    private $collectionFactory;

    /**
    * @var CmsBlockNotificationRepositoryInterface
    */
    private $cmsBlockNotificationRepository;

    /**
    * @var Filter
    */
    protected $filter;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param CmsBlockNotificationRepositoryInterface $cmsBlockNotificationRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CmsBlockNotificationRepositoryInterface $cmsBlockNotificationRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->cmsBlockNotificationRepository = $cmsBlockNotificationRepository;

        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws NotFoundException
     * @throws LocalizedException
     */
    public function execute(): Redirect
    {
        if (!$this->getRequest()->isPost()) {
            throw new NotFoundException(__('Page not found'));
        }

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $cmsBlockNotification = 0;

        foreach ($collection->getItems() as $cmsBlock) {
            $this->cmsBlockNotificationRepository->delete($cmsBlock);
            $cmsBlockNotification++;
        }

        if ($cmsBlockNotification) {
            $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $cmsBlockNotification)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)
            ->setPath('*/*/index');
    }
}
