<?php

namespace Models;

use Traits\Makable;

class Product extends Model
{
    use Makable;

    public string $make;
    public string $model;
    public string $colour;
    public string $capacity;
    public string $network;
    public string $grade;
    public string $condition;
}
