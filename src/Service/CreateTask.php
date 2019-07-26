<?php


namespace EventSchema\Service;


use EventSchema\Event\EventInterface;

class CreateTask implements ServiceInterface
{
    public function run(EventInterface $event): bool
    {
        echo "CreateTask\n";

        return true;
    }
}
