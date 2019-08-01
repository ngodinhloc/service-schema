<?php

namespace ServiceSchema\Event;

use ServiceSchema\Json\JsonReader;

class Message implements MessageInterface
{
    /** @var string */
    public $event;

    /** @var string */
    public $time;

    /** @var array|null|\stdClass */
    public $payload;

    /**
     * Event constructor.
     *
     * @param string|null $event
     * @param array|null|\stdClass $payload
     * @param string|null $time
     */
    public function __construct(string $event = null, string $time = null, $payload = null)
    {
        $this->event = $event;
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
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @param string $event
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $event = null)
    {
        $this->event = $event;

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
     * @return \ServiceSchema\Event\Message
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
     * @return \ServiceSchema\Event\Message
     */
    public function setPayload($payload = null)
    {
        $this->payload = $payload;

        return $this;
    }

}
