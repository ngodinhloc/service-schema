<?php

namespace ServiceSchema\Tests\Event;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Event\Message;

class MessageTest extends TestCase
{

    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    /**
     * @covers \ServiceSchema\Event\Message::setPayload
     * @covers \ServiceSchema\Event\Message::setTime
     * @covers \ServiceSchema\Event\Message::setEvent
     * @covers \ServiceSchema\Event\Message::setId
     * @covers \ServiceSchema\Event\Message::getId
     * @covers \ServiceSchema\Event\Message::setStatus
     * @covers \ServiceSchema\Event\Message::getStatus
     * @covers \ServiceSchema\Event\Message::toJson
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function testToJson()
    {
        $event = new Message();
        $event->setEvent("Test.Event.Name");
        $event->setTime("SomeTimeString");
        $event->setPayload((object) ["name" => "Ken"]);
        $event->setStatus("new");

        $json = $event->toJson();
        $this->assertTrue(is_string($json));
        $this->assertEquals('{"id":null,"event":"Test.Event.Name","time":"SomeTimeString","payload":{"name":"Ken"},"source":null,"description":null,"status":"new","sagaId":null,"attributes":null}', $json);

        $event = new Message();
        $event->setEvent("Users.afterSaveCommit.Create");
        $event->setTime("20190730123000");
        $event->setPayload(["user" => ["data" => ["name" => "Ken"]], "account" => ["data" => ["name" => "Brighte"]]]);
        $json = $event->toJson();
        $this->assertTrue(is_string($json));
        $this->assertEquals('{"id":null,"event":"Users.afterSaveCommit.Create","time":"20190730123000","payload":{"user":{"data":{"name":"Ken"}},"account":{"data":{"name":"Brighte"}}},"source":null,"description":null,"status":null,"sagaId":null,"attributes":null}', $json);

        $event = new Message();
        $event->setId(111);
        $id = $event->getId();
        $this->assertSame($id, '111');

        $event->setStatus('status');
        $status = $event->getStatus();
        $this->assertSame($status, 'status');

        $event->setDescription('description');
        $status = $event->getDescription();
        $this->assertSame($status, 'description');

    }
}
