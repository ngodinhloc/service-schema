<?php

namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateContact";

        return new Event();
    }
}
