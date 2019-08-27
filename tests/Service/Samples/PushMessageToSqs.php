<?php

namespace ServiceSchema\Tests\Service\Samples;

use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class PushMessageToSqs extends Service implements ServiceInterface
{
    public function consume(MessageInterface $message = null)
    {
        echo "Push message to SQS";

        return true;
    }
}
