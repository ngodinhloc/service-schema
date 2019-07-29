<?php

namespace ServiceSchema\Tests\Main;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Event\EventInterface;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Main\Processor;
use ServiceSchema\Main\ProcessorInterface;

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
        $message = JsonReader::read($this->testDir . "\jsons\\messages\\Users.afterSaveCommit.Create.json");
        $this->processor = new UserProcess([$this->testDir . "\jsons\\configs\\events.json"], [$this->testDir . "\jsons\\configs\services.json"], $this->testDir);
        $this->processor->process($message);
    }
}

class UserProcess extends Processor implements ProcessorInterface
{
    public function afterRun(EventInterface $event = null)
    {
        echo "I do afterRun";

        return true;
    }
}
