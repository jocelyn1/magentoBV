<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;

use Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\Page;

/**
 * Class Index
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml\Notification
 */
class Index extends Notification
{
    /** @var PageFactory */
    private $pageFactory;

    public function __construct(
        Context $context,
        Registry $registry,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;

        parent::__construct($context, $registry);
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this
            ->pageFactory
            ->create();

        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Cms Block Notification'));

        return $resultPage;
    }
}
