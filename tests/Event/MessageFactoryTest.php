<?php

namespace ServiceSchema\Tests\Event;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Event\Message;
use ServiceSchema\Event\MessageFactory;

class MessageFactoryTest extends TestCase
{
    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    /**
     * @covers \ServiceSchema\Event\MessageFactory::createMessage
     * @covers \ServiceSchema\Event\MessageFactory::validate
     * @covers \ServiceSchema\Event\Message::getEvent
     * @covers \ServiceSchema\Event\Message::getTime
     * @covers \ServiceSchema\Event\Message::getPayload
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function testCreateEvent()
    {
        $messageFactory = new MessageFactory();
        $json = '{"name":"Test.Event.Name","time":"SomeTimeString","payload":{"name":"Ken"}}';
        $message = $messageFactory->createMessage($json);
        $this->assertTrue($message instanceof Message);
        $this->assertEquals("Test.Event.Name", $message->getEvent());
        $this->assertEquals("SomeTimeString", $message->getTime());
        $this->assertEquals((object)["name" => "Ken"], $message->getPayload());
    }
}
