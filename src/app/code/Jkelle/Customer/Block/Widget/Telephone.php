<?php

namespace Jkelle\Customer\Block\Widget;

use Jkelle\Customer\Model\System\Config;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Block\Widget\Telephone as TelephoneBase;
use Magento\Customer\Helper\Address as AddressHelper;
use Magento\Customer\Model\Options;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Telephone
 * @package Jkelle\Customer\Block\Widget
 */
class Telephone extends TelephoneBase
{
    /** @var Config */
    private $config;

    public function __construct(
        Context $context,
        AddressHelper $addressHelper,
        CustomerMetadataInterface $customerMetadata,
        Options $options,
        AddressMetadataInterface $addressMetadata,
        Config $config,
        array $data = []
    )
    {
        $this->config = $config;
        parent::__construct($context,
            $addressHelper,
            $customerMetadata,
            $options,
            $addressMetadata,
            $data
        );
    }

    /**
     * @return string
     */
    public function getRegexForPhone(): string
    {
        return $this->config->getFieldPhone();
    }

}
