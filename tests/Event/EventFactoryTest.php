<?php

namespace ServiceSchema\Tests\Event;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventFactory;

class EventFactoryTest extends TestCase
{
    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    /**
     * @covers \ServiceSchema\Event\EventFactory::createEvent
     * @covers \ServiceSchema\Event\EventFactory::validate
     * @covers \ServiceSchema\Event\Event::getName
     * @covers \ServiceSchema\Event\Event::getTime
     * @covers \ServiceSchema\Event\Event::getPayload
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function testCreateEvent()
    {
        $eventFactory = new EventFactory();
        $json = '{"name":"Test.Event.Name","time":"SomeTimeString","payload":{"name":"Ken"}}';
        $event = $eventFactory->createEvent($json);
        $this->assertTrue($event instanceof Event);
        $this->assertEquals("Test.Event.Name", $event->getName());
        $this->assertEquals("SomeTimeString", $event->getTime());
        $this->assertEquals((object)["name" => "Ken"], $event->getPayload());
    }
}
