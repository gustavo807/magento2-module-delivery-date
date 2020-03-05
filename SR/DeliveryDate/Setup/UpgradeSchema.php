<?php
namespace SR\DeliveryDate\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '2.0.3', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('quote_address'),
                'delivery_date',
                [
                    'type' => 'datetime',
                    'nullable' => false,
                    'comment' => 'Delivery Date',
                ]
            );

            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order_address'),
                'delivery_date',
                [
                    'type' => 'datetime',
                    'nullable' => false,
                    'comment' => 'Delivery Date',
                ]
            );
        }

        $setup->endSetup();
    }
}
