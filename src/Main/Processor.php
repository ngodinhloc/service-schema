<?php

namespace ServiceSchema\Main;

use ServiceSchema\Config\EventRegister;
use ServiceSchema\Config\ServiceRegister;
use ServiceSchema\Event\EventFactory;
use ServiceSchema\Event\EventInterface;
use ServiceSchema\Json\JsonReader;
use ServiceSchema\Service\Exception\ServiceException;
use ServiceSchema\Service\ServiceFactory;
use ServiceSchema\Service\ServiceInterface;
use ServiceSchema\Service\ServiceValidator;

class Processor implements ProcessorInterface
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
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs()
    {
        $this->eventRegister->loadEvents();
        $this->serviceRegister->loadServices();
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
        if (empty($event)) {
            return false;
        }

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

                $jsonSchema = $registerService[$serviceName][ServiceRegister::INDEX_SCHEMA];
                $callbacks = $registerService[$serviceName][ServiceRegister::INDEX_CALLBACKS];
                $service = $this->serviceFactory->createService($serviceName, $jsonSchema);
                if (empty($service)) {
                    continue;
                }

                $this->runService($event, $service, $callbacks);
            }
        }

        return true;
    }

    /**
     * @param \ServiceSchema\Event\EventInterface|null $event
     * @param \ServiceSchema\Service\ServiceInterface|null $service
     * @param array $callbacks
     * @return bool
     * @throws \ServiceSchema\Json\Exception\JsonException
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function runService(EventInterface $event = null, ServiceInterface $service = null, array $callbacks = null)
    {
        $json = JsonReader::decode($event->toJson());
        $validator = $this->serviceValidator->validate($json, $service);
        if (!$validator->isValid()) {
            throw  new ServiceException(ServiceException::INVALIDATED_JSON_STRING . json_encode($validator->getErrors()));
        }

        if (isset($json->payload)) {
            $event->setPayload($json->payload);
        }

        $result = $service->run($event);
        if (($result instanceof EventInterface) && !empty($callbacks)) {
            return $this->runCallbacks($result, $callbacks);
        }

        return $result;
    }

    /**
     * @param \ServiceSchema\Event\EventInterface|null $event
     * @param array|null $callbacks
     * @return bool
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function runCallbacks(EventInterface $event, array $callbacks = null)
    {
        if (empty($callbacks)) {
            return true;
        }

        foreach ($callbacks as $callback) {
            $service = $this->serviceFactory->createService($callback);
            if (empty($service)) {
                continue;
            }

            $service->run($event);
        }

        return true;
    }
}
