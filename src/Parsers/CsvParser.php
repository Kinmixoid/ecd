<?php

namespace Parsers;

use Models\Model;
use Services\Counter;

class CsvParser implements ParserInterface
{
    public function __construct(private string $filename, private array $headerMaps, private Counter $counter)
    {
    }
    public function parse(string $modelClass, array $summarizeBy): array
    {
        $handle = fopen($this->filename, "r");
        $headers = fgetcsv($handle);

        $this->counter->reset();
        $this->counter->setGroupBy($summarizeBy);

        while ($data = fgetcsv($handle)) {
            // We'll make a new instance of a model and populate it with the data from the CSV row
            $model = $modelClass::make(array_combine($headers, $data), $this->headerMaps[$modelClass]);

            $this->counter->count($model);
        }
        fclose($handle);

        return $this->counter->getData();
    }
}
