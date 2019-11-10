<?php

namespace ServiceSchema\Tests\Main;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Main\Processor;
use ServiceSchema\Service\Exception\ServiceException;
use ServiceSchema\Service\SagaInterface;

class ProcessorTest extends TestCase
{
    protected $testDir;

    /** @var Processor */
    protected $processor;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
        $this->processor = new Processor([$this->testDir . "/jsons/configs/events.json"], [$this->testDir . "/jsons/configs/services.json"], $this->testDir);
    }

    /**
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Main\Exception\ProcessorException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testProcess()
    {
        $message = JsonReader::read($this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.json");
        $result = $this->processor->process($message);
        $this->assertTrue(is_bool($result));
    }

    /**
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Main\Exception\ProcessorException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testProcessFailed()
    {
        $message = JsonReader::read($this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.Failed.json");
        $this->expectException(ServiceException::class);
        $this->processor->process($message);
    }

    /**
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Main\Exception\ProcessorException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testRollback()
    {
        $message = JsonReader::read($this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.json");
        $result = $this->processor->rollback($message);
        $this->assertTrue(is_bool($result));
    }

    public function testSettersAndGetters()
    {
        $eventRegister = $this->processor->getEventRegister();
        $this->processor->setEventRegister($eventRegister);
        $this->assertSame($eventRegister, $this->processor->getEventRegister());

        $serviceRegister = $this->processor->getServiceRegister();
        $this->processor->setServiceRegister($serviceRegister);
        $this->assertSame($serviceRegister, $this->processor->getServiceRegister());

        $messageFactory = $this->processor->getMessageFactory();
        $this->processor->setMessageFactory($messageFactory);
        $this->assertSame($messageFactory, $this->processor->getMessageFactory());

        $serviceFactory = $this->processor->getServiceFactory();
        $this->processor->setServiceFactory($serviceFactory);
        $this->assertSame($serviceFactory, $this->processor->getServiceFactory());

        $serviceValidator = $this->processor->getServiceValidator();
        $this->processor->setServiceValidator($serviceValidator);
        $this->assertSame($serviceValidator, $this->processor->getServiceValidator());
    }
}
