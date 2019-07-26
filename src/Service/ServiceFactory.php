<?php

namespace EventSchema\Service;

use EventSchema\Event\Event;

class ServiceFactory
{
    /** @var \EventSchema\Service\ServiceRegister */
    protected $serviceRegister;

    /**
     * ServiceFactory constructor.
     *
     * @param \EventSchema\Service\ServiceRegister|null $serviceRegister
     */
    public function __construct(ServiceRegister $serviceRegister = null)
    {
        $this->serviceRegister = $serviceRegister;
    }

    public function createServices(Event $event = null)
    {
        $servicesList = $this->serviceRegister->retrieve($event->name);
        $services = [];
        foreach ($servicesList as $class) {
            $services[] = new $class();
        }

        return $services;
    }
}
