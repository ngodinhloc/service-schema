<?php

namespace ServiceSchema\Event;


interface EventInterface
{
    /**
     * @return false|string
     */
    public function toJson();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getTime();

    /**
     * @param string $time
     * @return \ServiceSchema\Event\Event
     */
    public function setTime(string $time = null);

    /**
     * @param string $name
     * @return \ServiceSchema\Event\Event
     */
    public function setName(string $name = null);

    /**
     * @return array|null|\stdClass
     */
    public function getPayload();

    /**
     * @param array|\stdClass $payload
     * @return \ServiceSchema\Event\Event
     */
    public function setPayload($payload = null);
}
