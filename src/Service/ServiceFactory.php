<?php

namespace ServiceSchema\Service;

use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventRegister;

class ServiceFactory
{
    /** @var \ServiceSchema\Event\EventRegister */
    protected $eventRegister;

    /** @var \ServiceSchema\Service\ServiceRegister */
    protected $serviceRegister;

    /**
     * ServiceFactory constructor.
     *
     * @param \ServiceSchema\Service\ServiceRegister|null $serviceRegister
     */
    public function __construct(EventRegister $eventRegister = null, ServiceRegister $serviceRegister = null)
    {
        $this->eventRegister = $eventRegister;
        $this->serviceRegister = $serviceRegister;
    }

    /**
     * @param \ServiceSchema\Event\Event|null $event
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
