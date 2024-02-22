<?php

namespace Services;

use Models\Model;

class Counter
{
    private array $data = [];
    private array $groupBy;
    public function __construct()
    {
    }

    public function count(Model $model): void
    {
        // lets gather properties that we'll need to group by
        $values = [];
        foreach ($this->groupBy as $property) {
            $values[] =$model->$property;
        }

        // We'll generate a unique key for the group
        $key = md5(implode('|', $values));

        // lets check if it's a first entry for a group
        // and if so create it and store the values
        if (!isset($summary[$key])) {
            $this->data[$key] = ['count'=>0, 'values'=>$values];
        }

        // And increment the summary count for the generated key
        $this->data[$key]['count']++;
    }

    public function setGroupBy(array $groupBy): void
    {
        $this->groupBy = $groupBy;
    }

    public function reset(): void
    {
        $this->data = [];
    }

    public function getData(): array
    {
        return $this->data;
    }
}
