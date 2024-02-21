<?php

namespace Models;

abstract class Model
{
    public static function make(array $data, $headerMap): Model
    {
        $model = new static();
        foreach ($headerMap as $header=>$property) {
            $model->$property = $data[$header];
        }
        return $model;
    }
}
