<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Rokezzz\OrderType\Api\GetOrderTypeLabelInterface;
use Rokezzz\OrderType\Block\Adminhtml\Form\Field\OrderTypeMap;

class OrderType extends Column
{
    private GetOrderTypeLabelInterface $getOrderTypeLabel;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param GetOrderTypeLabelInterface $getOrderTypeLabel
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        GetOrderTypeLabelInterface $getOrderTypeLabel,
        array $components = [],
        array $data = []
    ) {
        $this->getOrderTypeLabel = $getOrderTypeLabel;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[OrderTypeMap::CODE] = $this->getOrderTypeLabel->execute((string)$item[OrderTypeMap::CODE]);
            }
        }

        return $dataSource;
    }
}
