<?php

namespace EventSchema\Service;

use EventSchema\Event\EventInterface;

class CreateContact implements ServiceInterface
{
    public function run(EventInterface $event): bool
    {
        echo "CreateContact";

        return true;
    }
}
