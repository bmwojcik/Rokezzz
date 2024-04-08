<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Rokezzz\OrderType\Model\Config;

class OrderType implements ArgumentInterface
{
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function isOrderTypeEnabled(): bool
    {
        return $this->config->isOrderTypeEnabled();
    }

    public function getOrderTypeMapping(): array
    {
        return $this->config->getOrderTypeMapping();
    }
}
