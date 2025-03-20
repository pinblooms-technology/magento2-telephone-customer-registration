<?php

namespace Pinblooms\RegistrationPhone\Block;

class CustomerData extends \Magento\Framework\View\Element\Template
{
    /**
     * @var mixed The customer data associated with this property.
     */
    private $customer;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    /**
     * Constructor for the CustomerData class.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context The context object for template rendering.
     * @param \Magento\Customer\Model\Session $customer The customer session object.
     * @param array $data Additional data for the template.
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customer,
        array $data = []
    ) {
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    /**
     * Retrieves the phone number of the customer.
     *
     * @return string The customer's phone number.
     */
    public function phoneNumber()
    {
        $phoneNumber = $this->customer->getCustomer()->getPhoneNumber();
        return $phoneNumber;
    }
}
