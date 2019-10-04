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
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return \ServiceSchema\Event\Message
     */
    public function setId(string $id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string|null $event
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string|null $time
     * @return \ServiceSchema\Event\Message
     */
    public function setTime(string $time = null)
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
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return \ServiceSchema\Event\Message
     */
    public function setStatus(string $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param string|null $direction
     * @return \ServiceSchema\Event\Message
     */
    public function setDirection(string $direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return \ServiceSchema\Event\Message
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return \ServiceSchema\Event\Message
     */
    public function setSource(string $source = null)
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
    public function setExtra($extra = null)
    {
        $this->extra = $extra;

        return $this;
    }
}
