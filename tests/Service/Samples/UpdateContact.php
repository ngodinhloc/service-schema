<?php

namespace ServiceSchema\Tests\Service\Samples;

use ServiceSchema\Event\MessageInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class UpdateContact extends Service implements ServiceInterface
{
    public function consume(MessageInterface $message = null)
    {
        echo "UpdateContact";

        return true;
    }
}
