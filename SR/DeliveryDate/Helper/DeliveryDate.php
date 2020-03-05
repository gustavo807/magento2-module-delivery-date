<?php

namespace Sr\DeliveryDate\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\View\LayoutFactory;

class DeliveryDate extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $_layoutFactory;

    /**
     * Next id for edit delivery date block
     *
     * @var int
     */
    protected $_nextId = 0;

    /**
     * DeliveryDate constructor.
     * @param Context $context
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        LayoutFactory $layoutFactory
    ) {
        $this->_layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    public function getInline(\Magento\Framework\DataObject $entity)
    {
        return $this->_layoutFactory->create()->createBlock(\SR\DeliveryDate\Block\DeliveryDate\Inline::class)
            ->setId('delivery_date_form_' . $this->_nextId++)
            //->setDontDisplayContainer($dontDisplayContainer)
            ->setEntity($entity)
            //->setCheckoutType($type)
            ->toHtml();
    }
}
