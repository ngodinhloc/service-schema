<?php

namespace ServiceSchema\Tests\Main;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Main\Processor;

class ProcessorTest extends TestCase
{
    protected $testDir;

    /** @var Processor */
    protected $processor;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
        $this->processor = new Processor([$this->testDir . "\jsons\\configs\\events.json"], [$this->testDir . "\jsons\\configs\services.json"], $this->testDir);
    }

    /**
     * @covers \ServiceSchema\Main\Processor::process
     * @covers \ServiceSchema\Main\Processor::runService
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testProcess()
    {
        $message = JsonReader::read($this->testDir . "\jsons\\messages\\Users.afterSaveCommit.Create.json");
        $this->processor->process($message);
    }
}
