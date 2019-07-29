<?php

namespace ServiceSchema\Event;


interface EventInterface
{
    /**
     * @return false|string
     */
    public function toJson();
}
