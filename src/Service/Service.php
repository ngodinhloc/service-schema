<?php


namespace ServiceSchema\Service;


class Service
{
    /** @var string */
    protected $schema;

    /**
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param string $schema
     * @return Service
     */
    public function setSchema(string $schema = null)
    {
        $this->schema = $schema;

        return $this;
    }
}
