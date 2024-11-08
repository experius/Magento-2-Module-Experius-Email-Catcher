# Magento 2 Module Experius email catcher / - logger

    ``experius/module-emailcatcher``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Versions](#markdown-header-versions)
 - [Enable email catcher](#markdown-header-enable-email-catcher)

## Main Functionalities
 - Log all Emails send by Magento
 - View email content in popup (Nice for testing and styling)
 - Forward a caught email
 - Resend a caught email
 - Cleanup emails older than 30 days (cron or manual)
 - Send emails based on whitelisted email templates
 - Block emails based on blacklisted email list
 - Enable admin user to receive email while magento email communication is disabled


## Versions

- Version 4.x or higher is compatible with Magento >= 2.4.6-p2; PHP >= 8.2

- Version 3.x is compatible with Magento >= 2.2.0 <= 2.4.5; PHP 7.4 compatible

[**Please note that from 3.0.0 onward the composer require changed to experius/module-emailcatcher**]

- Version 2.0.0 or higher is compatible with Magento 2.2 or higher
- Version 1.3.2 or higher is compatible with Magento 2.1.8 or higher
- Version lower then 1.3.2 could still be used for Magento 2.1.7 or lower but we recommend to install a newer version

## Installation
In production please use the `--keep-generated` option

### Type 1: Zip file
 - Unzip the zip file in `app/code/Experius/EmailCatcher`
 - Enable the module by running `php bin/magento module:enable Experius_EmailCatcher`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer
 - Make the module available in a composer repository for example:
    - public repository `packagist.org`
    - public github repository as vcs
 - Install the module composer by running `composer require experius/module-emailcatcher`
 - Enable the module by running `php bin/magento module:enable Experius_EmailCatcher`
 - Apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`

## Enable email catcher
Enable Email Catcher.
 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Email Catcher (emailcatcher/general/enabled)

Disable email sending (default Magento, advised for development)
 - Stores > Settings > Configuration > Advanced > System > Mail Sending Settings > Disable Email Communications (system/smpt/disable)

Utilise whitelist functionality
- Stores > Settings > Configuration > Advanced > Email Catcher > Whitelist > Apply whitelist (emailcatcher/whitelist/apply_whitelist)
- Stores > Settings > Configuration > Advanced > Email Catcher > Whitelist > Whitelisted templates (emailcatcher/whitelist/email_templates)

Utilise blacklist functionality
- Stores > Settings > Configuration > Advanced > Email Catcher > Blacklist > Apply blacklist (emailcatcher/blacklist/apply_blacklist)
- Stores > Settings > Configuration > Advanced > Email Catcher > Blacklist > Blacklisted templates (emailcatcher/blacklist/block_email_addresses)

Utilise enable admin user receive email
- Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Admin User Receive Email (emailcatcher/development/enabled)
- Stores > Settings > Configuration > Advanced > Email Catcher > General > Admin User Email (emailcatcher/development/allow_email_addresses)

Admin grid
 - System > Tools > Email Catcher
