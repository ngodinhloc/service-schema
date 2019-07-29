<?php


namespace ServiceSchema\Service;


class Service
{
    /** @var string */
    protected $jsonSchema;

    /**
     * @return string
     */
    public function getJsonSchema()
    {
        return $this->jsonSchema;
    }

    /**
     * @param string $schema
     * @return Service
     */
    public function setJsonSchema(string $schema = null)
    {
        $this->jsonSchema = $schema;

        return $this;
    }
}
