<?php

namespace Experius\EmailCatcher\Test\Integration;

use Magento\TestFramework\ObjectManager;
use Magento\TestFramework\Helper\Bootstrap;

class EmailCatcherTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @magentoDataFixture Magento/Sales/_files/order.php
     * @magentoDbIsolation disabled
     * @magentoConfigFixture current_store emailcatcher/general/smtp_disable 1
     *
     */
    public function testEmailCatch(){

        /* @var $order \Magento\Sales\Model\Order */
        $order = Bootstrap::getObjectManager()->create(\Magento\Sales\Model\Order::class);
        $order->loadByIncrementId('100000001');

        $this->assertEmpty($order->getEmailSent());

        /* @var $emailSender \Magento\Sales\Model\Order\Email\Sender\OrderSender */
        $emailSender = Bootstrap::getObjectManager()->create(\Magento\Sales\Model\Order\Email\Sender\OrderSender::class);
        $emailSendResult = $emailSender->send($order);

        $this->assertTrue($emailSendResult);

        $this->assertNotEmpty($order->getEmailSent());

        /* @var $emailCatcher \Experius\EmailCatcher\Model\Emailcatcher */
        $emailCatcher = Bootstrap::getObjectManager()->create(\Experius\EmailCatcher\Model\Emailcatcher::class);
        $emailCatcher->load('customer@null.com','to');

        $this->assertEquals('customer@null.com',$emailCatcher->getTo());

    }

}