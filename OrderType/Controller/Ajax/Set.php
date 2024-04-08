<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Controller\Ajax;

use Exception;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;


class Set implements HttpPostActionInterface
{
    private RequestInterface $request;

    private JsonFactory $resultJsonFactory;

    private CartRepositoryInterface $cartRepository;

    private QuoteIdMaskFactory $quoteIdMaskFactory;

    /**
     * @param RequestInterface $request
     * @param JsonFactory $resultJsonFactory
     * @param CartRepositoryInterface $cartRepository
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     */
    public function __construct(
        RequestInterface $request,
        JsonFactory $resultJsonFactory,
        CartRepositoryInterface $cartRepository,
        QuoteIdMaskFactory $quoteIdMaskFactory
    ) {
        $this->request = $request;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->cartRepository = $cartRepository;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    /**
     * @return Json
     */
    public function execute(): Json
    {
        $result = false;
        $orderType = (string)$this->request->getParam('order_type');
        $cartId = $this->request->getParam('quote_id');

        if ((int)$cartId <= 0) {
            $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
            $cartId = $quoteIdMask->getQuoteId();

        }

        if (!$this->request->isAjax() || !$orderType || !$cartId) {
            return $this->resultJsonFactory->create()->setData($result);
        }

        try {
            $cart = $this->cartRepository->getActive($cartId);
            $cart->setOrderType($orderType);
            $this->cartRepository->save($cart);

            $result = true;
            // @codingStandardsIgnoreLine
        } catch (Exception $exception) {}

        return $this->resultJsonFactory->create()->setData($result);
    }

}
