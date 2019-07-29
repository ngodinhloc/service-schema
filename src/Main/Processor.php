<?php

namespace ServiceSchema\Main;

use ServiceSchema\Config\EventRegister;
use ServiceSchema\Config\ServiceRegister;
use ServiceSchema\Event\Event;
use ServiceSchema\Event\EventFactory;
use ServiceSchema\Event\EventInterface;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Service\ServiceFactory;
use ServiceSchema\Service\ServiceInterface;
use ServiceSchema\Service\ServiceValidator;

class Processor
{
    /** @var \ServiceSchema\Config\EventRegister */
    protected $eventRegister;

    /** @var \ServiceSchema\Config\ServiceRegister */
    protected $serviceRegister;

    /** @var \ServiceSchema\Event\EventFactory */
    protected $eventFactory;

    /** @var \ServiceSchema\Service\ServiceFactory */
    protected $serviceFactory;

    /** @var \ServiceSchema\Service\ServiceValidator */
    protected $serviceValidator;

    /**
     * ServiceProvider constructor.
     *
     * @param array|null $eventConfigs
     * @param array|null $serviceConfigs
     * @param string|null $schemaDir
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(array $eventConfigs = null, array $serviceConfigs = null, string $schemaDir = null)
    {
        $this->eventRegister = new EventRegister($eventConfigs);
        $this->serviceRegister = new ServiceRegister($serviceConfigs);
        $this->serviceFactory = new ServiceFactory();
        $this->eventFactory = new EventFactory();
        $this->serviceValidator = new ServiceValidator(null, $schemaDir);
        $this->loadConfigs();
    }

    /**
     * @param string|null $message
     * @return bool
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function process(string $message = null)
    {
        $event = $this->eventFactory->createEvent($message);
        $registeredEvents = $this->eventRegister->retrieveEvent($event->getName());

        if (empty($registeredEvents)) {
            return false;
        }

        foreach ($registeredEvents as $eventName => $services) {
            if (empty($services)) {
                continue;
            }

            foreach ($services as $serviceName) {
                $registerService = $this->serviceRegister->retrieveService($serviceName);
                if (empty($registerService)) {
                    continue;
                }

                $jsonSchema = $registerService[$serviceName];
                $service = $this->serviceFactory->createService($serviceName, $jsonSchema);

                $this->runService($event, $service);
            }
        }
    }

    /**
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs()
    {
        $this->eventRegister->loadEvents();
        $this->serviceRegister->loadServices();
    }

    /**
     * @param \ServiceSchema\Event\EventInterface|null $event
     * @param \ServiceSchema\Service\ServiceInterface|null $service
     * @return bool
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    protected function runService(EventInterface $event = null, ServiceInterface $service = null)
    {
        $json = JsonReader::decode($event->toJson());
        $validate = $this->serviceValidator->validate($json, $service);
        if ($validate) {
            $result = $service->run($event);
            if ($result instanceof Event) {
                if ($this instanceof ProcessorInterface)
                    return $this->afterRun($event);
            }

            return $result;
        }
    }
}
