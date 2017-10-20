Magento 2 Module Experius  Email Catcher
====================

Email Catcher / Logger Module for Magento 2.  The module makes it possible to fully disable the email communication when configured correctly.

   ``experius/emailcatcher``
   
 - [Main Functionalities](#markdown-header-main-functionalities)

- - -

# Main Functionalities

 - Disable Email Communication
 - Log Emails
 
 ---
 
#### Disable Email Communication

Disable all email communication when the flowing settings are set to Yes.

 - Stores > Settings > Configuration > Advanced > System > Mail Sending Settings > Disable Email Communications (system/smpt/disable)
 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Email Catcher (emailcatcher/general/enabled)
 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Disable Email Sending (emailcatcher/general/smtp_disable)

#### Log Emails

If the module is enabled all emails which are sent will be logged in the database so the Admin User can always check how the email is displayed and if it is created.

These sent emails can be found in the Admin Panel:

 - System > Tools > Email Catcher


Enabled through the following setting:

 - Stores > Settings > Configuration > Advanced > Email Catcher > General > Enable Email Catcher (emailcatcher/general/enabled)
