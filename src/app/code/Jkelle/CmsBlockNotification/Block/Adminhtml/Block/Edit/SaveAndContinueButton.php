<?php

namespace Jkelle\CmsBlockNotification\Block\Adminhtml\Block\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinueButton
 * @package Jkelle\CmsBlockNotification\Block\Adminhtml\Block\Edit
 */
class SaveAndContinueButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
