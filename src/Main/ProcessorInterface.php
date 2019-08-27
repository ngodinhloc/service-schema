<?php

namespace ServiceSchema\Main;

use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\ServiceInterface;

interface ProcessorInterface
{

    /**
     * @param string|null $json
     * @param bool $return
     * @return mixed
     */
    public function process(string $json = null, bool $return = false);

    /**
     * @param \ServiceSchema\Event\MessageInterface|null $message
     * @param \ServiceSchema\Service\ServiceInterface|null $service
     * @param array|null $callbacks
     * @return mixed
     */
    public function runService(MessageInterface $message = null, ServiceInterface $service = null, array $callbacks = null);

    /**
     * @param \ServiceSchema\Event\MessageInterface $event
     * @param array|null $callbacks
     * @return mixed
     */
    public function runCallbacks(MessageInterface $event, array $callbacks = null);
}
