Magento 2 Module Experius Email Catcher / Logger
====================

### Versions
- Version 2.0.0 or higher is compatible with Magento 2.2 or higher
- Version lower then 2.0.0 is compatible with Magento 2.1 or higher

### Installation
 ```composer require experius/emailcatcher```

Email Catcher / Logger Module for Magento 2. 

### Main Functionalities
 - Log all Emails send by Magento
 - View email in popup (Nice for testing and styling)
 - Forward catched emails
 - Resend catched emails
 - 30 days cron cleanup of catched emails
 

#### Enable Email Catcher

Enable Email Catcher.

 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Email Catcher (emailcatcher/general/enabled)

Disable email sending (default Magento)

 - Stores > Settings > Configuration > Advanced > System > Mail Sending Settings > Disable Email Communications (system/smpt/disable)

Admin grid

 - System > Tools > Email Catcher

