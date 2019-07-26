<?php

namespace EventSchema\Service;

use EventSchema\Event\Event;
use EventSchema\Event\EventRegister;

class ServiceFactory
{
    /** @var \EventSchema\Event\EventRegister */
    protected $eventRegister;

    /** @var \EventSchema\Service\ServiceRegister */
    protected $serviceRegister;

    /**
     * ServiceFactory constructor.
     *
     * @param \EventSchema\Service\ServiceRegister|null $serviceRegister
     */
    public function __construct(EventRegister $eventRegister = null, ServiceRegister $serviceRegister = null)
    {
        $this->eventRegister = $eventRegister;
        $this->serviceRegister = $serviceRegister;
    }

    /**
     * @param \EventSchema\Event\Event|null $event
     * @return array
     */
    public function createServices(Event $event = null)
    {
        $servicesList = $this->eventRegister->retrieveEvent($event->name);
        $services = [];
        foreach ($servicesList as $class) {
            $service = new $class();
            if ($service instanceof ServiceInterface) {
                $schema = $this->serviceRegister->retrieveService($class);
                $service->setSchema($schema);
                $services[] = $service;
            }
        }

        return $services;
    }
}
