<?php

namespace ServiceSchema\Event;

class Event implements EventInterface
{
    /** @var string */
    public $name;

    /** @var string */
    public $time;

    /** @var array */
    public $payload;

    /**
     * Event constructor.
     *
     * @param string|null $name
     * @param array|null $payload
     * @param string|null $time
     */
    public function __construct(string $name = null, string $time = null, array $payload = null)
    {
        $this->name = $name;
        $this->time = $time ?? date("YmdHis");
        $this->payload = $payload;
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this);
    }
}
