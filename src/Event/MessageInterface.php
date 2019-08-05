<?php

namespace ServiceSchema\Event;


interface MessageInterface
{
    /**
     * @return false|string
     */
    public function toJson();

    /**
     * @return string
     */
    public function getEvent();

    /**
     * @return string
     */
    public function getTime();

    /**
     * @param string $time
     * @return \ServiceSchema\Event\Message
     */
    public function setTime(string $time = null);

    /**
     * @param string $name
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $name = null);

    /**
     * @return array|null|\stdClass
     */
    public function getPayload();

    /**
     * @param array|\stdClass $payload
     * @return \ServiceSchema\Event\Message
     */
    public function setPayload($payload = null);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     * @return \ServiceSchema\Event\Message
     */
    public function setStatus(string $status = null);
}
