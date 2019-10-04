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

    /** @var array|null|\stdClass */
    protected $payload;

    /** @var string */
    protected $status;

    /** @var string */
    protected $direction;

    /** @var string */
    protected $source;

    /** @var string */
    protected $description;

    /** @var array|null|\stdClass */
    protected $extra;

    /**
     * Message constructor.
     *
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->event = isset($data['event']) ? $data['event'] : null;
        $this->time = isset($data['time']) ? $data['time'] : date("Y-m-d H:i:s");
        $this->payload = isset($data['payload']) ? $data['payload'] : null;
        $this->status = isset($data['status']) ? $data['status'] : null;
        $this->direction = isset($data['direction']) ? $data['direction'] : null;
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->source = isset($data['source']) ? $data['source'] : null;
        $this->extra = isset($data['extra']) ? $data['extra'] : null;
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
            "direction" => $this->direction,
            "description" => $this->description,
            "source" => $this->source,
            "extra" => $this->extra
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
     * @return \ServiceSchema\Event\Message
     */
    public function setId(string $id = null): Message
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
    public function setEvent(string $event = null): Message
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     * @return \ServiceSchema\Event\Message
     */
    public function setTime(string $time = null): Message
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return array|\stdClass|null
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param array|\stdClass|null $payload
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return \ServiceSchema\Event\Message
     */
    public function setStatus(string $status = null): Message
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     * @return \ServiceSchema\Event\Message
     */
    public function setDirection(string $direction = null): Message
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return \ServiceSchema\Event\Message
     */
    public function setDescription(string $description = null): Message
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return \ServiceSchema\Event\Message
     */
    public function setSource(string $source = null): Message
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return array|\stdClass|null
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param array|\stdClass|null $extra
     * @return \ServiceSchema\Event\Message
     */
    public function setExtra($extra = null): Message
    {
        $this->extra = $extra;

        return $this;
    }

}
