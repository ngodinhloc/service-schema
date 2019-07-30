<?php

namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class PushMessageToLog extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "Push message to Log";

        return true;
    }
}
