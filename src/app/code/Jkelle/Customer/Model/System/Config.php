<?php

namespace Jkelle\Customer\Model\System;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 * @package Jkelle\Customer\Model\System
 */
class Config
{
    /** @var string */
    const VALIDATION_FORM = 'validation_form';

    /** @var string */
    const GROUP_FIELDS = 'fields';

    /** @var string */
    const FIELD_PHONE = 'phone';

    /** @var string */
    const FIELD_POSTCODE = 'postcode';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getFieldPhone(): string
    {
        return (string)$this->scopeConfig->getValue(implode('/', [
            static::VALIDATION_FORM,
            static::GROUP_FIELDS,
            static::FIELD_PHONE
        ]));
    }

    /**
     * @return string
     */
    public function getFieldPostcode(): string
    {
        return (string)$this->scopeConfig->getValue(implode('/', [
            static::VALIDATION_FORM,
            static::GROUP_FIELDS,
            static::FIELD_POSTCODE
        ]));
    }
}
