<?php

namespace Traits;

use Models\Model;

trait Makable
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
