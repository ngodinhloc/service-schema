<?php


namespace ServiceSchema\Json;


interface JsonReaderInterface
{
    /**
     * @param string|null $file
     * @return string
     */
    public static function read(string $file = null);

    /**
     * @param string|null $json
     * @return array|mixed
     */
    public static function decode(string $json = null);
}
