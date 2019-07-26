<?php

namespace EventSchema\Service;

use EventSchema\Event\EventInterface;

interface ServiceInterface
{
    /**
     * @param \EventSchema\Event\EventInterface $event
     * @return bool
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
