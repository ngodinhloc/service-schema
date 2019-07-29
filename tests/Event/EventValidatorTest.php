<?php

namespace ServiceSchema\Tests\Event;

use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventRegister;
use ServiceSchema\Service\ServiceFactory;
use ServiceSchema\Service\ServiceInterface;
use ServiceSchema\Service\ServiceRegister;
use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class EventValidatorTest extends TestCase
{
    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    public function testEventValidator()
    {
        // put message to SQS
        $event = new Event("Users.afterSaveCommit.Create", ["user" => (object)["data" => ["name" => "Ken"]], "account" => (object)["data" => ["name" => "Brighte"]]]);
        $message = $event->toJson();

        // receive message from SQS
        $message = json_decode($message);

        // load config
        $eventRegister = new EventRegister([$this->testDir . "\json\configs\\events.json"]);
        $serviceRegister = new ServiceRegister([$this->testDir . "\json\configs\services.json"]);
        $serviceFactory = new ServiceFactory($eventRegister, $serviceRegister);;

        $validator = new Validator();
        $services = $serviceFactory->createServices($event);
        /** @var ServiceInterface $service */
        foreach ($services as $service) {
            $schemaJson = $this->testDir . "\json\schemas\\" . $service->getSchema();
            $schema = json_decode(file_get_contents($schemaJson));
            $validator->validate($message, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);
            $this->assertTrue($validator->isValid());

            /** @var ServiceInterface $service */
            $service->run($event);
        }


//        var_dump($message->payload);
        foreach ($message as $key => $value) {
//           var_dump($key);
//           var_dump($value);
        }
    }
}
