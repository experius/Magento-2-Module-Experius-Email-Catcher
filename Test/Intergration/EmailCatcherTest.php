<?php

namespace Experius\EmailCatcher\Test\Integration;

use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Helper\Bootstrap;

class EmailCatcherTest extends \PHPUnit\Framework\TestCase
{

    const XML_PATH_EMAIL_SENDER = 'custom2';

    const XML_PATH_EMAIL_TEMPLATE = 'test-email';

    const XML_PATH_EMAIL_TO = 'emailcatcher-to@experius.nl';

    /**
     *
     * @magentoDataFixture Magento/Sales/_files/order.php
     * @magentoDbIsolation disabled
     * @magentoConfigFixture current_store emailcatcher/general/smtp_disable 1
     * @magentoConfigFixture current_store system/smtp/disable 1
     *
     */
    public function testEmailCatch()
    {

        /* @var $transportBuilder \Experius\EmailCatcher\Test\Mail\Template\TransportBuilder */
        $transportBuilder = Bootstrap::getObjectManager()->create(\Experius\EmailCatcher\Test\Mail\Template\TransportBuilder::class);

        /* @var $scopeConfig \Magento\Framework\App\Config\ScopeConfigInterface */
        $scopeConfig = Bootstrap::getObjectManager()->create(\Magento\Framework\App\Config\ScopeConfigInterface::class);

        $variables = [];

        $transport = $transportBuilder
            ->setTemplateIdentifier(self::XML_PATH_EMAIL_TEMPLATE)
            ->setTemplateOptions(
                [
                    'area' => 'frontend',
                    'store' => 1
                ]
            )
            ->setTemplateVars($variables)
            ->setFrom(self::XML_PATH_EMAIL_SENDER)
            ->addTo(self::XML_PATH_EMAIL_TO)
            ->setReplyTo('derrick@experius.nl', 'Derrick')
            ->getTransport();

        $transport->sendMessage();

        /* @var $emailCatcher \Experius\EmailCatcher\Model\Emailcatcher */
        $emailCatcher = Bootstrap::getObjectManager()->create(\Experius\EmailCatcher\Model\Emailcatcher::class);
        $emailCatcher->load(self::XML_PATH_EMAIL_TO, 'to');

        $this->assertEquals(self::XML_PATH_EMAIL_TO, $emailCatcher->getTo());
        $this->assertEquals('<h1>test-email</h1>', $emailCatcher->getBody());
        $this->assertEquals('Test Email', $emailCatcher->getSubject());
    }
}
