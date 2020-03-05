<?php

namespace SR\DeliveryDate\Block\DeliveryDate;

use Magento\Framework\View\Element\Template;
use SR\DeliveryDate\Model\Config;

class Inline extends \Magento\Framework\View\Element\Template
{
    /**
     * @var mixed
     */
    protected $_entity = null;

    /**
     * @var string
     */
    protected $_template = 'SR_DeliveryDate::inline.phtml';

    /**
     * @var Config
     */
    private $config;

    public function __construct(
        Template\Context $context,
        Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
    }

    /**
     * Set entity
     *
     * @param mixed $entity
     * @return $this
     * @codeCoverageIgnore
     */
    public function setEntity($entity)
    {
        $this->_entity = $entity;
        return $this;
    }

    /**
     * Get entity
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function getEntity()
    {
        return $this->_entity;
    }

    public function getDeliveryDate()
    {
        $preValue = $this->getEntity()->getDeliveryDate();

        if ($preValue && $preValue !== "0000-00-00 00:00:00") {
            return $preValue;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getConfigJson()
    {
        return json_encode($this->config->getConfig());
    }
}
