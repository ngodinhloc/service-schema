<?php

namespace ServiceSchema\Event;

use ServiceSchema\Json\Exception\JsonException;
use ServiceSchema\Json\JsonReader;

class EventFactory
{
    /**
     * @param string|null $json
     * @return false|\ServiceSchema\Event\Event
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function createEvent(string $json = null)
    {
        if (empty($json)) {
            throw new JsonException(JsonException::MISSING_JSON_CONTENT);
        }

        $object = JsonReader::decode($json);

        if (!$this->validate($object)) {
            return false;
        }

        return new Event($object->name, isset($object->time) ? $object->time : null, $object->payload);
    }

    /**
     * @param null|\stdClass $object
     * @return bool
     */
    public function validate(\stdClass $object = null)
    {
        if (!is_object($object)) {
            return false;
        }

        if (!isset($object->name) || !isset($object->payload)) {
            return false;
        }

        return true;
    }
}
