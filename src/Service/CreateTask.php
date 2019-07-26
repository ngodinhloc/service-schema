<?php


namespace EventSchema\Service;


use EventSchema\Event\EventInterface;

class CreateTask extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "CreateTask";

        return true;
    }
}
