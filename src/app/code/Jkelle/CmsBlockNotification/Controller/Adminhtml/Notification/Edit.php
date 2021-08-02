<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;

use Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;
use Magento\Backend\App\Action\Context ;
use Magento\Framework\Controller\ResultInterface;
use Jkelle\CmsBlockNotification\Api\CmsBlockNotificationRepositoryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\Page;

/**
 * Class Edit
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification
 */
class Edit extends Notification
{
    /** @var CmsBlockNotificationRepositoryInterface */
    private $cmsBlockNotificationRepository;

    /** @var PageFactory */
    private $pageFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        CmsBlockNotificationRepositoryInterface $cmsBlockNotificationRepository,
        PageFactory $pageFactory
    )
    {
        $this->cmsBlockNotificationRepository = $cmsBlockNotificationRepository;
        $this->pageFactory = $pageFactory;

        parent::__construct($context, $registry);
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        if ($id = $this->getRequest()->getParam('id')) {
            $model = $this->cmsBlockNotificationRepository->get($id, 'entity_id');
            if (!$model->getId()) {
                $this->messageManager->addError(__('This notification block no exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }

            $this->registry->register('Jkelle_CmsBlockNotification', $model);
        }

        /** @var Page $resultPage */
        $resultPage = $this
            ->pageFactory
            ->create();

        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Block') : __('New Block'),
            $id ? __('Edit Block') : __('New Block')
        );

        $resultPage
            ->getConfig()
            ->getTitle()
            ->prepend(__('Cms Block Notification'));

        return $resultPage;
    }
}
