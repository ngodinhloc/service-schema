<?php


namespace EventSchema\Tests\Service;


use EventSchema\Event\EventInterface;
use EventSchema\Service\ServiceInterface;

class UpdateContact implements ServiceInterface
{
    public function run(EventInterface $event): bool
    {
        echo "UpdateContact";

        return true;
    }
}
