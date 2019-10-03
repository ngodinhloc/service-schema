<?php

namespace ServiceSchema\Event;

use ServiceSchema\Json\JsonReader;

class Message implements MessageInterface
{

    /** @var string */
    protected $id;

    /** @var string */
    protected $event;

    /** @var string */
    protected $time;

    /** @var string */
    protected $queue;

    /** @var string */
    protected $jwt;

    /** @var array|null|\stdClass */
    protected $payload;

    /** @var string */
    protected $status;

    const STATUS_NEW = "new";
    const STATUS_FAILED = "failed";
    const STATUS_SUCCEEDED = "succeeded";

    /**
     * Event constructor.
     *
     * @param string|null $event
     * @param string|null $time
     * @param string|null $queue
     * @param string|null $jwt
     * @param array|null|\stdClass $payload
     * @param string|null $status
     */
    public function __construct(string $event = null, string $time = null, $payload = null, string $status = self::STATUS_NEW, string $queue = null, string $jwt = null)
    {
        $this->event = $event;
        $this->time = $time ? $time : date("Y-m-d H:i;s");
        $this->payload = $payload;
        $this->status = $status;
        $this->queue = $queue;
        $this->jwt = $jwt;
    }

    /**
     * @return false|string
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function toJson()
    {
        return JsonReader::encode([
            "id" => $this->id,
            "event" => $this->event,
            "time" => $this->time,
            "payload" => $this->payload,
            "status" => $this->status,
            "queue" => $this->queue,
            "jwt" => $this->jwt
        ]);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Message
     */
    public function setId(string $id): Message
    {
        $this->id = $id;

        return $this;
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
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param string $queue
     * @return \ServiceSchema\Event\Message
     */
    public function setQueue(string $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return string
     */
    public function getJwt()
    {
        return $this->jwt;
    }

    /**
     * @param string $jwt
     * @return \ServiceSchema\Event\Message
     */
    public function setJwt(string $jwt = null)
    {
        $this->jwt = $jwt;

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

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return \ServiceSchema\Event\Message
     */
    public function setStatus(string $status = null)
    {
        $this->status = $status;

        return $this;
    }
}
