<?php

declare(strict_types=1);

namespace Pinblooms\RegistrationPhone\Setup\Patch\Data;

use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CustomerAttribute for Create Customer Attribute using Data Patch.
 */
class CustomerAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Attribute
     */
    private $attributeResource;

    /**
     * CustomerAttribute Constructor
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     * @param LoggerInterface $logger
     * @param \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        LoggerInterface $logger,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * Apply function
     *
     * @return void
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->addPhoneAttribute();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * AddPhoneAttribute function
     *
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function addPhoneAttribute()
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'phone_number',
            [
                'type' => 'varchar',
                'label' => 'Phone Number',
                'input' => 'text',
                'required' => 1,
                'visible' => 1,
                'user_defined' => 1,
                'sort_order' => 999,
                'position' => 999,
                'system' => 0,
                'is_used_in_grid' => true,
                'is_visible_in_grid'    => true
            ]
        );

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'phone_number');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        $attribute->setData('used_in_forms', [
            'adminhtml_customer',
            'customer_account_create',
            'customer_account_edit',
            'adminhtml_customer_address',
            'customer_address_edit',
            'customer_register_address'
        ]);

        $this->attributeResource->save($attribute);
    }

    /**
     * GetDependencies function
     *
     * @return void
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Revert function
     *
     * @return void
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'phone_number');
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * GetAliases function
     *
     * @return void
     */
    public function getAliases()
    {
        return [];
    }
}
