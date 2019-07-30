<?php

namespace ServiceSchema\Main;

use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\ServiceInterface;

interface ProcessorInterface
{
    /**
     * @param string|null $message
     * @return mixed
     */
    public function process(string $message = null);

    /**
     * @param \ServiceSchema\Event\EventInterface|null $event
     * @param \ServiceSchema\Service\ServiceInterface|null $service
     * @param array|null $callbacks
     * @return mixed
     */
    public function runService(EventInterface $event = null, ServiceInterface $service = null, array $callbacks = null);

    /**
     * @param \ServiceSchema\Event\EventInterface $event
     * @param array|null $callbacks
     * @return mixed
     */
    public function runCallbacks(EventInterface $event, array $callbacks = null);
}
