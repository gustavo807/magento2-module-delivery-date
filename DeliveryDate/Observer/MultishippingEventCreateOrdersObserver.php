<?php

namespace SR\DeliveryDate\Observer;

use Magento\Framework\Event\ObserverInterface;

class MultishippingEventCreateOrdersObserver implements ObserverInterface
{
    /**
     * Set delivery date to order from address in multiple addresses checkout.
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $observer->getEvent()->getOrder()->setDeliveryDate($observer->getEvent()->getAddress()->getDeliveryDate());

        return $this;
    }
}
