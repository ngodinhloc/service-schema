<?php

namespace ServiceSchema\Tests\Main;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Main\Processor;
use ServiceSchema\Service\Exception\ServiceException;

class ProcessorTest extends TestCase
{
    protected $testDir;

    /** @var Processor */
    protected $processor;

    /**
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    /**
     * @covers \ServiceSchema\Main\Processor::process
     * @covers \ServiceSchema\Main\Processor::runService
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testProcess()
    {
        $message = JsonReader::read($this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.json");
        $this->processor = new Processor([$this->testDir . "/jsons/configs/events.json"], [$this->testDir . "/jsons/configs/services.json"], $this->testDir);
        $result = $this->processor->process($message);
        $this->assertTrue(is_bool($result));
    }

    /**
     * @covers \ServiceSchema\Main\Processor::process
     * @covers \ServiceSchema\Main\Processor::runService
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testProcessFailed()
    {
        $message = JsonReader::read($this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.Failed.json");
        $this->processor = new Processor([$this->testDir . "/jsons/configs/events.json"], [$this->testDir . "/jsons/configs/services.json"], $this->testDir);
        $this->expectException(ServiceException::class);
        $this->processor->process($message);
    }
}
