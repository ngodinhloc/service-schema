<?php


namespace ServiceSchema\Json;


use ServiceSchema\Json\Exception\JsonException;

class JsonReader implements JsonReaderInterface
{
    /**
     * @param string|null $file
     * @return string
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public static function read(string $file = null)
    {
        if (empty($file)) {
            throw new JsonException(JsonException::MISSING_JSON_FILE);
        }

        if (!is_file($file)) {
            throw new JsonException(JsonException::INVALID_JSON_FILE);
        }

        return file_get_contents($file);
    }

    /**
     * @param string|null $json
     * @return array|mixed
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public static function decode(string $json = null)
    {
        if (empty($json)) {
            throw new JsonException(JsonException::MISSING_JSON_CONTENT);
        }

        return json_decode($json);
    }

    /**
     * @param null|mixed $content
     * @return false|string
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public static function encode($content = null)
    {
        if (empty($content)) {
            throw new JsonException(JsonException::MISSING_JSON_CONTENT);
        }

        return json_encode($content);
    }
}
