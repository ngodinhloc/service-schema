<?php

namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class PushMessageToSqs extends Service implements ServiceInterface
{
    public function consume(MessageInterface $event = null)
    {
        echo "Push message to SQS";

        return true;
    }
}
