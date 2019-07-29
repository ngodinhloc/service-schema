<?php

namespace ServiceSchema\Config;

use ServiceSchema\Json\JsonReader;

class ServiceRegister
{
    /** @var array $configs */
    protected $configs = [];

    /** @var array $services */
    protected $services = [];

    /**
     * ServiceRegister constructor.
     *
     * @param array|null $configs
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(array $configs = null)
    {
        $this->configs = $configs;
        $this->loadServices();
    }

    /**
     * @return \ServiceSchema\Config\ServiceRegister
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    protected function loadServices()
    {
        foreach ($this->configs as $config) {
            $rows = JsonReader::decode(JsonReader::read($config), true);
            foreach ($rows as $row) {
                $service = $row["service"];
                $schema = $row["schema"];
                $this->registerService($service, $schema);
            }
        }

        return $this;
    }

    /**
     * @param string|null $serviceName
     * @param string|null $schema
     * @return \ServiceSchema\Config\ServiceRegister
     */
    public function registerService(string $serviceName = null, string $schema = null)
    {
        if (!isset($this->services[$serviceName])) {
            $this->services[$serviceName] = $schema;
        }

        return $this;
    }

    /**
     * @param string|null $serviceName
     * @return array|null
     */
    public function retrieveService(string $serviceName = null)
    {
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        return null;
    }
}
