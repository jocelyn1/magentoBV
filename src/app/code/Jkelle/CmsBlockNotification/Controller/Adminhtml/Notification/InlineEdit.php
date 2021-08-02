<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;

use Jkelle\CmsBlockNotification\Api\Data\CmsBlockNotificationInterface;
use Jkelle\CmsBlockNotification\Model\Entity\CmsBlockNotification;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action;
use Jkelle\CmsBlockNotification\Api\CmsBlockNotificationRepositoryInterface;

/**
 * Class InlineEdit
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification
 */
class InlineEdit extends Action
{
    /** @var string */
    const ADMIN_RESOURCE = 'Jkelle_CmsBlockNotification::notification';

    /**
     * @var CmsBlockNotificationRepositoryInterface
     */
    protected $cmsBlockNotificationRepository;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param CmsBlockNotificationRepositoryInterface $cmsBlockNotificationRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        CmsBlockNotificationRepositoryInterface $cmsBlockNotificationRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->cmsBlockNotificationRepository = $cmsBlockNotificationRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $blockId) {
                    /** @var CmsBlockNotification $block */
                    $block = $this->cmsBlockNotificationRepository->getId($blockId);
                    try {
                        $block->setData(array_merge($block->getData(), $postItems[$blockId]));
                        $this->cmsBlockNotificationRepository->save($block);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBlockId(
                            $block,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add block title to error message
     *
     * @param CmsBlockNotificationInterface $block
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBlockId(CmsBlockNotificationInterface $block, $errorText)
    {
        return '[Block ID: ' . $block->getId() . '] ' . $errorText;
    }
}
