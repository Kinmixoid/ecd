<?php

namespace Services;

class Configuration
{
    public function __construct(private array $data)
    {
    }

    // this function will recoursevly find the value in the array using dot notation
    public function get(string $key, mixed $default=null, array $array=null): mixed
    {
        if ($array===null) {
            $array = $this->data;
        }

        $keys = explode('.', $key);

        if (!isset($array[$keys[0]])) {
            return $default;
        }

        if (count($keys)===1) {
            return $array[$keys[0]];
        }

        return $this->get(
            implode('.', array_slice($keys, 1)),
            $default,
            $array[$keys[0]],
        );
    }
}
