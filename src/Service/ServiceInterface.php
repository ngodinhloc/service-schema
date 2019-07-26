<?php

namespace EventSchema\Service;

use EventSchema\Event\EventInterface;

interface ServiceInterface
{
    /**
     * @param \EventSchema\Event\EventInterface $event
     * @return bool
     */
    public function run(EventInterface $event): bool;
}
