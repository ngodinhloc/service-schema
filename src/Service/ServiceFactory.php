<?php

namespace ServiceSchema\Service;

use ServiceSchema\Service\Exception\ServiceException;

class ServiceFactory
{
    /**
     * @param string|null $serviceClass
     * @param string|null $schema
     * @return \ServiceSchema\Service\ServiceInterface|false
     * @throws \ServiceSchema\Service\Exception\ServiceException
     */
    public function createService(string $serviceClass = null, string $schema = null)
    {
        try {
            $service = new $serviceClass();
        } catch (\Exception $exception) {
            throw new ServiceException(ServiceException::INVALID_SERVICE_CLASS . $serviceClass);
        }

        if ($service instanceof ServiceInterface) {
            $service->setJsonSchema($schema);

            return $service;
        }

        return false;
    }
}
