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
     * @return string
     */
    public function getTime();

    /**
     * @param string $time
     * @return \ServiceSchema\Event\Message
     */
    public function setTime(string $time = null);

    /**
     * @param string $event
     * @return \ServiceSchema\Event\Message
     */
    public function setEvent(string $event = null);

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
    public function getQueue();

    /**
     * @param string $queue
     * @return \ServiceSchema\Event\Message
     */
    public function setQueue(string $queue = null);

    /**
     * @param string $jwt
     * @return \ServiceSchema\Event\Message
     */
    public function setJwt(string $jwt = null);
}
