<?php


namespace ServiceSchema\Main\Exception;

use ServiceSchema\Exception\ServiceSchemaException;

class ProcessorException extends ServiceSchemaException
{
    const FAILED_TO_CREATE_MESSAGE = "Failed to create message from json string";
    const NO_REGISTER_EVENTS = "No registered events for: ";
}
