<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;


use Jkelle\CmsBlockNotification\Api\CmsBlockNotificationRepositoryInterface;
use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotification as Model;
use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotificationFactory;
use Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;

/**
 * Class Save
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification
 */
class Save extends Notification
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var CmsBlockNotificationFactory
     */
    private $cmsBlockNotificationFactory;

    /**
     * @var CmsBlockNotificationRepositoryInterface
     */
    private $cmsBlockNotificationpRepository;

    /**
     * Save constructor.
     * @param Context $context
     * @param Registry $registry
     * @param DataPersistorInterface $dataPersistor
     * @param CmsBlockNotificationFactory $cmsBlockNotificationFactory
     * @param CmsBlockNotificationRepositoryInterface $cmsBlockNotificationpRepository
     */
    public function __construct(
        Context $context,
        Registry $registry,
        DataPersistorInterface $dataPersistor,
        CmsBlockNotificationFactory $cmsBlockNotificationFactory,
        CmsBlockNotificationRepositoryInterface $cmsBlockNotificationpRepository
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->cmsBlockNotificationFactory = $cmsBlockNotificationFactory;
        $this->cmsBlockNotificationpRepository = $cmsBlockNotificationpRepository;

        parent::__construct($context, $registry);
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue('notification');

        if ($data) {
            /** @var Model $model */
            $model = $this->cmsBlockNotificationFactory->create();

            $id = $this->getRequest()->getParam('notification')['entity_id'];
            if ($id) {
                try {
                    $model = $this->cmsBlockNotificationpRepository->getId($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This block no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->cmsBlockNotificationpRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the block.'));
                $this->dataPersistor->clear('jkelle_cmsblocknotification');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('jkelle_cmsblocknotification', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
