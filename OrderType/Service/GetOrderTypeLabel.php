<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Service;

use Rokezzz\OrderType\Api\GetOrderTypeLabelInterface;
use Rokezzz\OrderType\Model\Config;

class GetOrderTypeLabel implements GetOrderTypeLabelInterface
{
    private array $cachedValues;
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /** @inheritdoc */
    public function execute(string $orderType): string
    {
        if (!isset($this->cachedValues[$orderType])) {
            foreach ($this->config->getOrderTypeMapping() as $id => $label) {
                $this->cachedValues[$id] = $label;
            }
        }

        return $this->cachedValues[$orderType] ?? '';
    }
}
