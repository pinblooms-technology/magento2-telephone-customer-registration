# magento2-telephone-customer-registration
Add a telephone field on Customer registration form in magento 2

# Pinblooms_RegistrationPhone

## Overview
The `Pinblooms_RegistrationPhone` module adds a telephone field to the Magento 2 customer registration form. This allows customers to enter their phone number during registration, making it easier for store owners to contact them if needed.

## Features
- Adds a **Telephone** field to the customer registration form.
- Stores the telephone number in the customer entity.
- Fully compatible with Magento 2 standards.

## Installation
### 1. Upload the Module
Run the following command to navigate to the Magento root directory:
```sh
cd /path/to/magento/root
```
Copy the module files into `app/code/Pinblooms/RegistrationPhone/`.

### 2. Enable the Module
Run the following commands:
```sh
php bin/magento module:enable Pinblooms_RegistrationPhone
php bin/magento setup:upgrade
php bin/magento cache:flush
```

### 3. Deploy Static Content (If Required)
```sh
php bin/magento setup:static-content:deploy -f
```

## Configuration
No additional configuration is required. Once installed, the telephone field will automatically appear in the customer registration form.

![image (23)](https://github.com/user-attachments/assets/721e9cce-e5b3-45ce-9516-1f633cfd2880)

![image (21)](https://github.com/user-attachments/assets/f0d3eed6-3610-49fb-b393-3a8258602268)

![image (22)](https://github.com/user-attachments/assets/dcd4c46e-1cc5-4702-ba4c-bfc797b61228)

## Usage
1. Go to the **Customer Registration** page.
2. You will see a **Telephone** field added to the form.
3. Enter your phone number and complete the registration process.
4. The phone number will be added in admin customers grid column
5. You can edit and manage from customers account information

## Uninstallation
To remove the module, run:
```sh
php bin/magento module:disable Pinblooms_RegistrationPhone
php bin/magento setup:upgrade
php bin/magento cache:flush
```
Optionally, delete the module directory:
```sh
rm -rf app/code/Pinblooms/RegistrationPhone/
```

## Support
If you encounter any issues, feel free to contact the developer or open a GitHub issue.

---
**Developed by PinBlooms**


