<?php

namespace ServiceSchema\ServiceSamples;

use ServiceSchema\Event\Message;
use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class CreateContact extends Service implements ServiceInterface
{
    public function consume(MessageInterface $event = null)
    {
        echo "CreateContact";

        return new Message();
    }
}
