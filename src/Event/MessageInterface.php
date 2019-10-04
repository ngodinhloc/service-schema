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
    public function getId(): string;

    /**
     * @param string $id
     * @return Message
     */
    public function setId(string $id): Message;

    /**
     * @return string
     */
    public function getEvent();

    /**
     * @param string $event
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $event = null);

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

    /**
     * @return string
     */
    public function getDirection(): string;

    /**
     * @param string $direction
     * @return \ServiceSchema\Event\Message
     */
    public function setDirection(string $direction = null): Message;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     * @return \ServiceSchema\Event\Message
     */
    public function setDescription(string $description = null): Message;

    /**
     * @return string
     */
    public function getSource(): string;

    /**
     * @param string $source
     * @return \ServiceSchema\Event\Message
     */
    public function setSource(string $source = null): Message;

    /**
     * @return string
     */
    public function getExtra();

    /**
     * @param string $queue
     * @return \ServiceSchema\Event\Message
     */
    public function setExtra(string $queue = null);

}
