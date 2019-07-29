<?php

namespace ServiceSchema\Service;


use JsonSchema\Constraints\Constraint;
use JsonSchema\Validator;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Service\Exception\ServiceException;

class ServiceValidator
{
    /** @var \JsonSchema\Validator */
    protected $validator;

    /**
     * EventValidator constructor.
     *
     * @param \JsonSchema\Validator|null $validator
     */
    public function __construct(Validator $validator = null)
    {
        $this->validator = $validator ?? new Validator();
    }

    /**
     * @param \stdClass $jsonObject
     * @param \ServiceSchema\Service\ServiceInterface $service
     * @return bool
     * @throws \ServiceSchema\Service\Exception\ServiceException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function validate(\stdClass &$jsonObject = null, ServiceInterface $service = null)
    {
        if (empty($jsonObject)) {
            throw new ServiceException(ServiceException::MISSING_JSON_STRING);
        }

        if (empty($service->getJsonSchema())) {
            throw new ServiceException(ServiceException::MISSING_SERVICE_SCHEMA);
        }

        $schema = JsonReader::decode(JsonReader::read($service->getJsonSchema()));

        $this->validator->validate($jsonObject, $schema, Constraint::CHECK_MODE_APPLY_DEFAULTS);

        return $this->validator->isValid();
    }
}
