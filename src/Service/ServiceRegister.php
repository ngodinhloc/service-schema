<?php

namespace EventSchema\Service;

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
     */
    public function __construct(array $configs = null)
    {
        $this->configs = $configs;
        $this->loadServices();
    }

    /**
     * @return \EventSchema\Service\ServiceRegister
     */
    protected function loadServices()
    {
        foreach ($this->configs as $config) {
            $rows = json_decode(file_get_contents($config), true);
            foreach ($rows as $row) {
                $eventName = $row["event"];
                $services = $row["services"];
                $this->register($eventName, $services);
            }
        }

        return $this;
    }

    /**
     * @param string|null $eventName
     * @return mixed|null
     */
    public function retrieve(string $eventName = null)
    {
        if (isset($this->services[$eventName])) {
            return $this->services[$eventName];
        }

        return null;
    }

    /**
     * @param string|null $eventName
     * @param array|null $services
     */
    public function register(string $eventName = null, array $services = null)
    {
        if (!isset($this->services[$eventName])) {
            $this->services[$eventName] = $services;
        } else {
            $this->services[$eventName] = array_unique(array_merge($this->services[$eventName], $services));
        }
    }

    /**
     * @return array
     */
    public function getConfigs(): array
    {
        return $this->configs;
    }

    /**
     * @param array $configs
     * @return \EventSchema\Service\ServiceRegister
     */
    public function setConfigs(array $configs = null)
    {
        $this->configs = $configs;

        return $this;
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param array $services
     * @return \EventSchema\Service\ServiceRegister
     */
    public function setServices(array $services = null)
    {
        $this->services = $services;

        return $this;
    }
}
