<?php

namespace ServiceSchema\Event;

interface MessageInterface
{

    /**
     * @return false|string
     */
    public function toJson();

    /**
     * @return string|null
     */
    public function getId();

    /**
     * @param string|null $id
     * @return \ServiceSchema\Event\Message
     */
    public function setId(string $id = null);

    /**
     * @return string|null
     */
    public function getEvent();

    /**
     * @param string|null $event
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $event = null);

    /**
     * @return string|null
     */
    public function getTime();

    /**
     * @param string|null $time
     * @return \ServiceSchema\Event\Message
     */
    public function setTime(string $time = null);

    /**
     * @return array|\stdClass|null
     */
    public function getPayload();

    /**
     * @param array|\stdClass|null $payload
     * @return \ServiceSchema\Event\Message
     */
    public function setPayload($payload = null);

    /**
     * @return string|null
     */
    public function getStatus();

    /**
     * @param string|null $status
     * @return \ServiceSchema\Event\Message
     */
    public function setStatus(string $status = null);

    /**
     * @return string|null
     */
    public function getDirection();

    /**
     * @param string|null $direction
     * @return \ServiceSchema\Event\Message
     */
    public function setDirection(string $direction = null);

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @param string|null $description
     * @return \ServiceSchema\Event\Message
     */
    public function setDescription(string $description = null);

    /**
     * @return string|null
     */
    public function getSource();

    /**
     * @param string|null $source
     * @return \ServiceSchema\Event\Message
     */
    public function setSource(string $source = null);

    /**
     * @return array|\stdClass|null
     */
    public function getExtra();

    /**
     * @param array|\stdClass|null $extra
     * @return \ServiceSchema\Event\Message
     */
    public function setExtra($extra = null);

}
