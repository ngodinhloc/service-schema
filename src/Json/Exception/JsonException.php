<?php

namespace ServiceSchema\Json\Exception;

use ServiceSchema\Exception\ServiceSchemaException;

class JsonException extends ServiceSchemaException
{
    const INVALID_JSON_FILE = "Provided file is not a valid json file";
    const MISSING_JSON_FILE = "Missing json file";
    const MISSING_JSON_CONTENT = "Content is empty, please provide json content";
}
