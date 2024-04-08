<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Api;

interface GetOrderTypeLabelInterface
{
    /**
     * @param string $orderType
     *
     * @return string
     */
    public function execute(string $orderType): string;
}
