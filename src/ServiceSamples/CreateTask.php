<?php


namespace ServiceSchema\ServiceSamples;


use ServiceSchema\Event\EventInterface;
use ServiceSchema\Service\Service;
use ServiceSchema\Service\ServiceInterface;

class CreateTask extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateTask";

        return true;
    }
}
