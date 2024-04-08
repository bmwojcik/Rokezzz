<?php

declare(strict_types=1);

namespace Rokezzz\OrderType\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class OrderTypeMap extends AbstractFieldArray
{
    public const CODE = 'order_type';

    public const ID = 'id';

    protected function _prepareToRender(): void
    {
        $this->addColumn(
            self::CODE,
            [
                'label'     => __('Order Type'),
                'class'     => 'required-entry'
            ]
        );
        $this->addColumn(
            self::ID,
            [
                'label'     => __('Id'),
                'class'     => 'required-entry'
            ]
        );

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
