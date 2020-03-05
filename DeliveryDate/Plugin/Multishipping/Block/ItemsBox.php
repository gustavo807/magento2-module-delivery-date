<?php

namespace SR\DeliveryDate\Plugin\Multishipping\Block;

use Magento\Framework\DataObject;
use Magento\Multishipping\Block\Checkout\Shipping as ShippingBlock;
use SR\DeliveryDate\Helper\DeliveryDate as DeliveryDateHelper;

/**
 * Multishipping items box plugin
 */
class ItemsBox
{
    protected $helper;

    /**
     * ItemsBox constructor.
     * @param DeliveryDateHelper $helper
     */
    public function __construct(DeliveryDateHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Get items box message text for multishipping
     *
     * @param ShippingBlock $subject
     * @param string $itemsBoxText
     * @param DataObject $addressEntity
     *
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetItemsBoxTextAfter(ShippingBlock $subject, $itemsBoxText, DataObject $addressEntity)
    {
        return $this->helper->getInline($addressEntity)
            . $itemsBoxText;
    }
}
