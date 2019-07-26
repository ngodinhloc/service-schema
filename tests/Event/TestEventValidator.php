<?php

namespace EventSchema\Tests\Event;

use EventSchema\Event\Event;
use EventSchema\Service\ServiceFactory;
use EventSchema\Service\ServiceInterface;
use EventSchema\Service\ServiceRegister;
use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;
use PHPUnit\Framework\TestCase;

class TestEventValidator extends TestCase
{
    protected $testDir;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
    }

    public function testEventValidator()
    {
        $event = new Event("Users.afterSaveCommit.Create", ["user" => (object)["data" => ["name" => "Ken"]], "account" => (object)["data" => ["name" => "Brighte"]]]);
        $message = $event->toJson();
        $message = json_decode($message);
//        var_dump($message);

        $serviceRegister = new ServiceRegister([$this->testDir . "\json\configs\services.json"]);
        $serviceFactory = new ServiceFactory($serviceRegister);;

        $services = $serviceFactory->createServices($event);
        foreach ($services as $service) {
            /** @var ServiceInterface $service */
            $service->run($event);
        }
        die("");

//        $json = $this->testDir . "\json\messages\Users.afterSaveCommit.Create.json";
//        $message = json_decode(file_get_contents($json));
//        var_dump($message);

        $schemaJson = $this->testDir . "\json\schemas\CreateContact.json";
        $schema = json_decode(file_get_contents($schemaJson));
        $validator = new Validator();
        $validator->validate($message, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);

        var_dump($validator->isValid());
//        var_dump($message->payload);
        foreach ($message as $key => $value) {
//           var_dump($key);
//           var_dump($value);
        }
    }
}
