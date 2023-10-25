## 4.0.0 (2023-10-25)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/4.0.0)

*  [BUGFIX][IN23-251] Ported obsolete/deprecated install- and upgradeschema to db_schema.xml and db_schema_whitelist.json. *(Boris van Katwijk)*
*  [FEATURE][IN23-252] Make EmailCatcher PHP 8.2 compatible; rework constructs and remove backwards compatibility for lower versions of Magento. *(Boris van Katwijk)*


## 3.5.3 (2023-08-23)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.5.3)

*  [BUGFIX][#67][NEND-744] PHP Deprecated:  Creation of dynamic property Experius\EmailCatcher\Cron\Clean::$connection is deprecated in /Cron/Clean.php on line 49 *(Boris van Katwijk)*


## 3.5.2 (2022-10-12)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.5.2)

*  #63: ERROR - Run Cleanup *(Prashant Patel)*
*  Update function imapUtf8 with check on string type *(Experius)*


## 3.5.1 (2022-07-21)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.5.1)

*  [FEATURE][BACI-694] Changed adminhtml ui component to have dates in the grid based on timezone *(Quinn Stadens)*


## 3.5.0 (2021-02-19)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.5.0)

*  [FEATURE] - Restored old setupscripts. Allows for reinstall on a new M2.2 environment *(Rens Wolters)*
*  [FEATURE] - Added db_schema changes after removal of installscripts to installscripts *(Rens Wolters)*


## 3.4.4 (2020-11-25)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.4.4)

*  [REFACTOR] - Fix backwards compatibility with 2.2.X *(Ruben Panis)*


## 3.4.3 (2020-11-25)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.4.3)

*  [BUGFIX] - Add required parameter before optional parameter in constructor *(Ruben Panis)*


## 3.4.2 (2020-11-17)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.4.2)

*  [BUGFIX] - Fixed recipient string in resend message *(Ruben Panis)*


## 3.4.1 (2020-10-27)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.4.1)

*  [BUGFIX] fixed bug for email getting into spam cause of utf-8 *(martijnvanhaagen)*


## 3.4.0 (2020-10-22)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.4.0)

*  [FEATURE] [BACI-154] Added strict_types=1 and added License *(Lewis Voncken)*


## 3.3.2 (2020-10-21)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.3.2)

*  [REFACTOR] [BACI-157] Removed setup_version from module.xml *(Lewis Voncken)*


## 3.3.1 (2020-10-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.3.1)

*  [REFACTOR] Removed unused code or added suppression when unused code is allowed and applied phpcs fixes *(Lewis Voncken)*


## 3.3.0 (2020-09-09)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.3.0)

*  [FEATURE] Added clarification to configuration *(Matthijs Breed)*
*  [REFACTOR] - Getting rid of rewrites, prevents conflicts with other modules *(Ruben Panis)*
*  [FEATURE] - Converted old setup script to db_schema *(Ruben Panis)*
*  [BUGFIX] - Save template identifier on emailcatcher item to fix whitelist check on resend/forward *(Ruben Panis)*
*  [REFACTOR] - Some codesniffer fixes *(Ruben Panis)*
*  [BUGFIX] - Fixed class references *(Ruben Panis)*


## 3.2.0 (2020-07-07)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.2.0)

*  Add days to clean on configuration field *(Mauro Sempere)*
*  Add configuration to admin field *(Mauro Sempere)*
*  Refactor field *(Mauro Sempere)*


## 3.1.4 (2020-07-06)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.1.4)

*  Update UpgradeSchema.php *(Sudheer Kumar Nayak)*


## 3.1.3 (2020-04-01)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.1.3)

*  Fixes #47 undefined imap_utf8 *(Tomasz Gregorczyk)*


## 3.1.2 (2020-02-07)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.1.2)

*  Change old decoder to utf-8 encoder *(F43BL4CK)*


## 3.1.1 (2019-12-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.1.1)

*  [BUGFIX] Fix for installation error when magento uses prefix for database tables *(sergey)*
*  Fixes upgrade script to skip column change when columns already exist *(Rens Wolters)*


## 3.1.0 (2019-11-13)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.1.0)

*  [FEATURE] Created preferences on Magento email classes (Transport / TransportBuilder) to preserve template identifier on email transport. This will allow filtering of email sending (in sendMessage()) based of configurable template whitelist. *(Boris van Katwijk)*
*  [FEATURE] [SFTG-187] Added logic to check email versus whitelisted templates and send those configured to be whitelisted *(Matthijs Breed)*
*  [FEATURE] Added custom email templates to dropdown selector for templates to whitelist *(Matthijs Breed)*
*  [BUGFIX] Removed debugging code *(Matthijs Breed)*
*  [BUGFIX] Empty whitelist was still sending email, resolved this by making !empty() check on template whitelist. [REFACTOR] Small refactor for readability of class functions in plugin. *(Boris van Katwijk)*
*  [BUGFIX] Message for resending was incorrectly displaying empty email adress. Message rewritten to "email was resent". *(Boris van Katwijk)*
*  [DOCS] Updated README with 3.1.0 changes. Updated all authors. *(Boris van Katwijk)*


## 3.0.0 (2019-10-09)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/3.0.0)

*  [FEATURE] Magento 2.3.3 support for forwarding and resending emails using the newly introduced \Magento\Framework\Mail\EmailMessageInterface. Fully backwards compatible to 2.2.x *(Boris van Katwijk)*
*  [REFACTOR] Removed no longer in use test files. *(Boris van Katwijk)*
*  [REFACTOR] DocBlocks and License update. [FEATURE] Made days for cleanup a constant in the Cleanup class. *(Boris van Katwijk)*
*  [FEATURE] Add "something went wrong" message if email preview does not load correctly (ID could not be retrieved) for unknown reasons. *(Boris van Katwijk)*
*  [REFACTOR] Changed composer require namespace from "experius/emailcatcher" to "experius/module-emailcatcher". [DOCS] Updated authors of module. *(Boris van Katwijk)*
*  [DOCS] Updated README, starting change logs *(Boris van Katwijk)*
*  [REFACTOR] Unused code scan, removed unused parameter $resultPageFactory. *(Boris van Katwijk)*
*  [REFACTOR] Codescan PHPCBF --standard=PSR2 --severity=1 *(Boris van Katwijk)*


## 2.2.6 (2019-10-08)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.6)

*  [BUGFIX] __construct() dependency injection breaks on Emailcatcher model due to sort order of injected classes. *(Boris van Katwijk)*
*  [BUGFIX] UI xml argument: name="context" xsi:type="configurableObject" breaks adminhtml in Magento 2.3.3. [FEATURE] Removed redundant commented out xml in UI xml declaration for mass action. [FEATURE] Sort order changed to be a tad more logical in the adminhtml overview. [FEATURE] Removed "id" selection column, since no actions are present. *(Boris van Katwijk)*


## 2.2.5 (2019-10-01)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.5)

*  [TASK] Email body formatting quoted_printable_decode and removed argument class validation in saveMessage *(dheesbeen)*
*  [TASK] quoted_printable_decode only for Magento 2.3.3 or higher *(dheesbeen)*


## 2.2.4 (2019-09-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.4)

*  [BUGFIX] Changed installschema back to old version *(Daphne Witmer)*


## 2.2.3 (2019-09-02)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.3)

*  [BUGFIX][PGW-228] Fix more getters and setters *(Daphne Witmer)*


## 2.2.2 (2019-08-28)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.2)

*  [BUGFIX][PGW-228] Could not sort emails on 'to' and 'from' in adminpanel grid *(Daphne Witmer)*


## 2.2.1 (2018-12-10)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.1)

*  [TASK] removed unnecessary mail class, switch to mailTransportFactory *(dheesbeen)*


## 2.2.0 (2018-12-10)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.2.0)

*  [TASK] added date filter *(Derrick Heesbeen)*
*  [BUGFIX] Solved: Fatal error:  Access level to Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::_construct() must be protected (as in class Magento\Backend\Block\Widget\Form\Container) or weaker *(Lewis Voncken)*
*  [TASK] disabled missing plugin class for magento 2.1 or lower *(Derrick Heesbeen)*
*  [BUGFIX] di compile error fix, non excisting email/transport class *(Derrick Heesbeen)*
*  [TASK] Made transport class same as 2.1 version *(Derrick Heesbeen)*
*  [TASK] Added model event prefix and object name *(Derrick Heesbeen)*
*  [DOCS] Updated the README with compatible Magento 2 versions *(Lewis Voncken)*
*  [DOCS] Updated the README with compatible Magento 2 versions *(Lewis Voncken)*
*  [TASK] Magento 2.3 compatibility *(dheesbeen)*


## 1.3.10 (2018-10-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.10)

*  [TASK] added date filter *(Derrick Heesbeen)*
*  [BUGFIX] Solved: Fatal error:  Access level to Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::_construct() must be protected (as in class Magento\Backend\Block\Widget\Form\Container) or weaker *(Lewis Voncken)*
*  [TASK] disabled missing plugin class for magento 2.1 or lower *(Derrick Heesbeen)*
*  [BUGFIX] di compile error fix, non excisting email/transport class *(Derrick Heesbeen)*
*  [TASK] Made transport class same as 2.1 version *(Derrick Heesbeen)*
*  [TASK] Added model event prefix and object name *(Derrick Heesbeen)*
*  [DOCS] Updated the README with compatible Magento 2 versions *(Lewis Voncken)*
*  [DOCS] Updated the README with compatible Magento 2 versions *(Lewis Voncken)*


## 2.1.3 (2018-10-16)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.1.3)

*  [DOCS] Updated the README with compatible Magento 2 versions *(Lewis Voncken)*


## 2.1.2 (2018-01-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.1.2)

*  [TASK] Added model event prefix and object name *(Derrick Heesbeen)*


## 2.1.1 (2018-01-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.1.1)

*  [TASK] added date filter *(Derrick Heesbeen)*
*  [BUGFIX] Solved: Fatal error:  Access level to Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::_construct() must be protected (as in class Magento\Backend\Block\Widget\Form\Container) or weaker *(Lewis Voncken)*
*  [TASK] disabled missing plugin class for magento 2.1 or lower *(Derrick Heesbeen)*
*  [BUGFIX] di compile error fix, non excisting email/transport class *(Derrick Heesbeen)*
*  [TASK] Made transport class same as 2.1 version *(Derrick Heesbeen)*


## 1.3.9 (2018-01-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.9)

*  [BUGFIX] di compile error fix, non excisting email/transport class *(Derrick Heesbeen)*


## 1.3.8 (2018-01-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.8)

*  [TASK] removed preferences, replaced with plugin, add date filter, fixed little errors *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Version with no preferences, only plugin and backwards compatible *(Derrick Heesbeen)*
*  [TASK] disabled missing plugin class for magento 2.1 or lower *(Derrick Heesbeen)*


## 1.3.7 (2018-01-12)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.7)

*  [BUGFIX] Solved: Fatal error:  Access level to Experius\EmailCatcher\Block\Adminhtml\Forward\Edit::_construct() must be protected (as in class Magento\Backend\Block\Widget\Form\Container) or weaker *(Lewis Voncken)*


## 1.3.6 (2018-01-12)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.6)

*  [TASK] removed preferences, replaced with plugin, add date filter, fixed little errors *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] added date filter *(Derrick Heesbeen)*


## 2.1.0 (2018-01-11)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.1.0)

*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*
*  [TASK] Updated readme *(Derrick Heesbeen)*


## 2.0.0 (2018-01-11)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/2.0.0)

*  [TASK] psr-2 code formatting, MEQP2 code adjustments *(Derrick Heesbeen)*
*  [TASK] removed preferences, replaced with plugin, add date filter, fixed little errors *(Derrick Heesbeen)*


## 1.3.5 (2017-11-06)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.5)

*  [TASK] #8 added cleanup cron *(Derrick Heesbeen)*


## 1.3.4 (2017-10-24)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.4)

*  [TASK] added intergration test. Test if order email is catched *(Derrick Heesbeen)*
*  [TASK] Added intergration test *(Derrick Heesbeen)*


## 1.3.3 (2017-10-20)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.3)

*  [BUGFIX] grid filter history/bookmark save' *(Derrick Heesbeen)*


## 1.3.2 (2017-10-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.2)

*  [TASK] disable Magento_Email plugin. Its now possible to catch emails if smtp_disable is true *(Derrick Heesbeen)*


## 1.3.1 (2017-10-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.1)

*  [BUGFIX] magento 2.1.* fix *(Derrick Heesbeen)*


## 1.3.0 (2017-10-18)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.3.0)

*  [TASK] updated overwritten mail transporter with 2.2 feature/bugfixes *(Derrick Heesbeen)*


## 1.2.0 (2017-10-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.2.0)



## 1.2.1 (2017-10-15)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.2.1)

*  [FEATURE] forward email option, resend option *(Derrick Heesbeen)*


## 1.1.1 (2017-10-06)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.1.1)

*  Update README.md *(Mr. Lewis)*


## 1.1.0 (2017-10-03)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.1.0)

*  [BUGFIX] mime decode subject, magento 2.2 abstract method require fix *(Derrick Heesbeen)*


## 1.0.6 (2017-09-06)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.6)

*  [TASK] added acl *(Derrick Heesbeen)*


## 1.0.5 (2017-08-22)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.5)

*  [FEATURE] compatible with magento 2.1.8, added settings disable/enable *(Derrick Heesbeen)*


## 1.0.4 (2017-07-26)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.4)

*  [TASK] Removed email body from grid collection so it does not appear in de javascript array. It can cause javascript errors *(Derrick Heesbeen)*


## 1.0.3 (2017-04-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.3)

*  Use getBody() instead getBodyHtml() *(Sergio Jovani)*
*   compile fix *(Derrick Heesbeen)*
*  [BUGFIX] compile error fixes *(Derrick Heesbeen)*


## 1.0.2 (2016-12-30)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.2)

*   compile fix *(Derrick Heesbeen)*


## 1.0.1 (2016-10-26)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/1.0.1)

*  Readme update *(Derrick Heesbeen)*
*  Update composer.json *(Experius)*


## v1.0.0 (2016-09-23)

[View Release](git@github.com:experius/Magento-2-Module-Experius-Email-Catcher.git/commits/tag/v1.0.0)

*  First commit *(Derrick Heesbeen)*
*  beta version *(Derrick Heesbeen)*
*  added README *(Derrick Heesbeen)*
*  composer correct info *(Derrick Heesbeen)*
*  changed menu link, start with ui component js action extend *(Derrick Heesbeen)*
*  Option to disable all email sending *(Derrick Heesbeen)*
*  Action view link in popup *(Derrick Heesbeen)*


