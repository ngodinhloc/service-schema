<?php

namespace ServiceSchema\Service;

use ServiceSchema\Event\EventInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateContact";

        return true;
    }
}
