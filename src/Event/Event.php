<?php

namespace EventSchema\Event;

class Event implements EventInterface
{
    /** @var string */
    public $name;

    /** @var string */
    public $time;

    /** @var array */
    public $payload;

    /** @var string json file */
    protected $schema;

    public function __construct(string $name = null, array $payload = null, string $time = null, string $schema = null)
    {
        $this->name = $name;

        $this->payload = $payload;
        $this->time = $time ?? date("YmdHis");
        $this->schema = $schema;
    }

    /**
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param string $schema
     * @return \EventSchema\Event\Event
     */
    public function setSchema(string $schema = null)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode($this);
    }
}
