<?php

namespace ServiceSchema\Event;


class EventRegister
{
    /** @var array $configs */
    protected $configs = [];

    /** @var array $events */
    protected $events = [];

    public function __construct(array $configs = null)
    {
        $this->configs = $configs;
        $this->loadEvents();
    }

    /**
     * @return \ServiceSchema\Event\EventRegister
     */
    protected function loadEvents()
    {
        foreach ($this->configs as $config) {
            $rows = json_decode(file_get_contents($config), true);
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
     * @return \ServiceSchema\Event\EventRegister
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
