<?php

namespace ServiceSchema\Service;

use ServiceSchema\Event\EventInterface;

interface ServiceInterface
{
    /**
     * @param \ServiceSchema\Event\EventInterface $event
     * @return bool|\ServiceSchema\Event\EventInterface
     */
    public function run(EventInterface $event = null);

    /**
     * @param string $schema
     * @return bool
     */
    public function setSchema(string $schema = null);

    /**
     * @return string
     */
    public function getSchema();
}
