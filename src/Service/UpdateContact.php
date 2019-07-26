<?php


namespace EventSchema\Tests\Service;


use EventSchema\Event\EventInterface;
use EventSchema\Service\Service;
use EventSchema\Service\ServiceInterface;

class UpdateContact extends Service implements ServiceInterface
{
    public function run(EventInterface $event = null)
    {
        echo "UpdateContact";

        return true;
    }
}
