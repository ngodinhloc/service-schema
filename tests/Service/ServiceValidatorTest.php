<?php

namespace ServiceSchema\Tests\Service;

use PHPUnit\Framework\TestCase;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Service\ServiceValidator;
use ServiceSchema\ServiceSamples\CreateContact;

class ServiceValidatorTest extends TestCase
{
    protected $testDir;
    /** @var ServiceValidator */
    protected $serviceValidator;

    public function setUp()
    {
        parent::setUp();
        $this->testDir = dirname(dirname(__FILE__));
        $this->serviceValidator = new ServiceValidator();
    }

    /**
     * @covers \ServiceSchema\Service\ServiceValidator::validate
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function testValidate()
    {
        $file = $this->testDir . "/jsons/messages/Users.afterSaveCommit.Create.json";
        $jsonObject = JsonReader::decode(JsonReader::read($file));
        $service = new CreateContact();
        $service->setJsonSchema($this->testDir . "/jsons/schemas/CreateContact.json");
        $validator = $this->serviceValidator->validate($jsonObject, $service);
        $this->assertTrue($validator->isValid());
    }
}
