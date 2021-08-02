<?php

namespace Jkelle\CmsBlockNotification\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class CmsBlockNotificationActions
 * @package Jkelle\CmsBlockNotification\Ui\Component\Listing\Columns
 */
class CmsBlockNotificationActions extends Column
{
    /** @var string */
    const URL_PATH_EDIT = 'cms_block_notification/notification/edit';

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * CmsBlockNotificationActions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href'  => $this->urlBuilder->getUrl(
                            self::URL_PATH_EDIT,
                            ['id' => $item['entity_id']]),
                        'label' => __('Edit')
                    ],
                ];
            }
        }
        return $dataSource;
    }
}
