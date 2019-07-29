<?php

namespace ServiceSchema\Config;


use ServiceSchema\Json\JsonReader;

class EventRegister
{
    /** @var array $configs */
    protected $configs = [];

    /** @var array $events */
    protected $events = [];

    /**
     * EventRegister constructor.
     *
     * @param array|null $configs
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(array $configs = null)
    {
        $this->configs = $configs;
        $this->loadEvents();
    }

    /**
     * @return \ServiceSchema\Config\EventRegister
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    protected function loadEvents()
    {
        foreach ($this->configs as $config) {
            $rows = JsonReader::decode(JsonReader::read($config), true);
            foreach ($rows as $row) {
                $eventName = $row["event"];
                $services = $row["services"];
                $this->registerEvent($eventName, $services);
            }
        }

        return $this;
    }

    /**
     * @param string|null $eventName
     * @param array|null $services
     * @return \ServiceSchema\Config\EventRegister
     */
    public function registerEvent(string $eventName = null, array $services = null)
    {
        if (!isset($this->events[$eventName])) {
            $this->events[$eventName] = $services;
        } else {
            $this->events[$eventName] = array_unique(array_merge($this->events[$eventName], $services));
        }

        return $this;
    }

    /**
     * @param string|null $eventName
     * @return array|null
     */
    public function retrieveEvent(string $eventName = null)
    {
        if (isset($this->events[$eventName])) {
            return $this->events[$eventName];
        }

        return null;
    }
}
