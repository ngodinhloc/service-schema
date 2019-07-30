<?php

namespace ServiceSchema\Event;

use ServiceSchema\Json\JsonReader;

class Event implements EventInterface
{
    /** @var string */
    public $name;

    /** @var string */
    public $time;

    /** @var array|null|\stdClass */
    public $payload;

    /**
     * Event constructor.
     *
     * @param string|null $name
     * @param array|null|\stdClass $payload
     * @param string|null $time
     */
    public function __construct(string $name = null, string $time = null, $payload = null)
    {
        $this->name = $name;
        $this->time = $time ?? date("YmdHis");
        $this->payload = $payload;
    }

    /**
     * @return false|string
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function toJson()
    {
        return JsonReader::encode($this);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return \ServiceSchema\Event\Event
     */
    public function setName(string $name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return \ServiceSchema\Event\Event
     */
    public function setTime(string $time = null)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return array|null|\stdClass
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array|\stdClass $payload
     * @return \ServiceSchema\Event\Event
     */
    public function setPayload($payload = null)
    {
        $this->payload = $payload;

        return $this;
    }

}
