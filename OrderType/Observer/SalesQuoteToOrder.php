<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SalesQuoteToOrder implements ObserverInterface
{
    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer): void
    {
        $quote = $observer->getEvent()->getQuote();
        $order = $observer->getEvent()->getOrder();

        if ($orderType = $quote->getOrderType()) {
            $order->setOrderType($orderType);
        }
    }
}
