<?php

namespace EventSchema\Service;

use EventSchema\Event\EventInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateContact";

        return true;
    }
}
