<?php

namespace ServiceSchema\Tests\Event;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Event\Event;

class EventTest extends TestCase
{
    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    /**
     * @covers \ServiceSchema\Event\Event::setPayload
     * @covers \ServiceSchema\Event\Event::setTime
     * @covers \ServiceSchema\Event\Event::setName
     * @covers \ServiceSchema\Event\Event::toJson
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function testToJson()
    {
        $event = new Event();
        $event->setName("Test.Event.Name");
        $event->setTime("SomeTimeString");
        $event->setPayload(["name" => "Ken"]);
        $json = $event->toJson();
        // push to SQS
        $this->assertTrue(is_string($json));
        $this->assertEquals('{"name":"Test.Event.Name","time":"SomeTimeString","payload":{"name":"Ken"}}', $json);
    }
}
