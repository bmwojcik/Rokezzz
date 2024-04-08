<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Rokezzz\OrderType\Block\Adminhtml\Form\Field\OrderTypeMap;

class Config
{
    public const ROKEZZZ_ORDER_TYPE_ENABLED_XML_PATH = 'rokezzz_modules/order_type/enabled';

    public const ROKEZZZ_ORDER_TYPE_MAPPING = 'rokezzz_modules/order_type/map';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int|null $websiteId
     *
     * @return bool
     */
    public function isOrderTypeEnabled(?int $websiteId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::ROKEZZZ_ORDER_TYPE_ENABLED_XML_PATH,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }

    /**
     * @param int|null $websiteId
     *
     * @return array
     */
    public function getOrderTypeMapping(?int $websiteId = null): array
    {
        $config = (string)$this->scopeConfig->getValue(
            self::ROKEZZZ_ORDER_TYPE_MAPPING,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );

        $configMap = json_decode($config, true) ?? [];

        $result = [];

        if (is_array($configMap) && !empty($configMap)) {
            foreach ($configMap as $key => $row) {
                $result[$row[OrderTypeMap::ID]] = $row[OrderTypeMap::CODE];
            }
        }

        return $result;
    }
}
