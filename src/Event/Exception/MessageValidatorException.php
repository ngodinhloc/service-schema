<?php

namespace ServiceSchema\Event\Exception;

use ServiceSchema\Exception\ServiceSchemaException;

class MessageValidatorException extends ServiceSchemaException
{
    const INVALID_JSON_STRING = "Message->toJson is invalid Json string.";
    const MISSING_EVENT_SCHEMA = "Event schema is missing.";
}
