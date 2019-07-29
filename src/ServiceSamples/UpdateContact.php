<?php

namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class UpdateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "UpdateContact";

        return true;
    }
}
