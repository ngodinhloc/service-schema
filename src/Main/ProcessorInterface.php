<?php

namespace ServiceSchema\Main;

use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventInterface;

interface ProcessorInterface
{
    /**
     * @param EventInterface|null $event
     * @return bool
     */
    public function afterRun(EventInterface $event = null);
}
