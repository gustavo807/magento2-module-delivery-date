<?php

namespace SR\DeliveryDate\Model;

class DeliveryDateManager
{
    /**
     * @var Validator
     */
    private $validator;

    public function __construct(
        Validator $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * Add delivery dates values to quote address table
     * @param $deliveryDates
     * @param $quote
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function add($deliveryDates, $quote)
    {
        if (!is_array($deliveryDates)) {
            return $this;
        }

        $addresses = $quote->getAllShippingAddresses();

        foreach ($addresses as $address) {
            $addressId = $address->getId();

            if (!isset($deliveryDates[$addressId])) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Set empty delivery date for an address. Verify the delivery dates and try again.')
                );
            }

            if (!$this->validator->validate($deliveryDates[$addressId])
            ) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Set not valid delivery date for an address. Verify the delivery dates and try again.')
                );
            }

            $address->setDeliveryDate($deliveryDates[$addressId]);
        }

        return $this;
    }
}
