<?php

namespace Jkelle\CmsBlockNotification\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\Page;

/**
 * Class Notification
 * @package Jkelle\CmsBlockNotification\Controller\Adminhtml
 */
abstract class Notification extends Action
{
    /** @var string */
    const ADMIN_RESOURCE = 'Jkelle_CmsBlockNotification::notification';

    /** @var Registry */
    protected $registry;

    public function __construct(
        Context $context,
        Registry $registry
    )
    {
        $this->registry = $registry;

        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Jkelle_CmsBlockNotification::notification')
            ->addBreadcrumb(__('Test'), __('Test'))
            ->addBreadcrumb(__('Block Notification'), __('Block Notification'));
        return $resultPage;
    }

}
