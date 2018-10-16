Magento 2 Module Experius Email Catcher / Logger
====================

### Versions

- Version 2.0.0 or higher is compatible with Magento 2.2 or higher
- Version 1.3.2 or higher is compatible with Magento 2.1.8 or higher
- Version lower then 1.3.2 could still be used for Magento 2.1.7 or lower but we recommend to install a newer version


### Installation
 ```composer require experius/emailcatcher```

Email Catcher / Logger Module for Magento 2. 

### Main Functionalities
 - Log all Emails send by Magento
 - View email contecnt in popup (Nice for testing and styling)
 - Forward  a catched email
 - Resend  a catched email
 - Cleanup of emails older then 30 days (cron or manual)
 

#### Enable Email Catcher

Enable Email Catcher.

 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Email Catcher (emailcatcher/general/enabled)

Disable email sending (default Magento, advised for development)

 - Stores > Settings > Configuration > Advanced > System > Mail Sending Settings > Disable Email Communications (system/smpt/disable)

Admin grid

 - System > Tools > Email Catcher

