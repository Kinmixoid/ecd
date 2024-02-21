<?php

namespace Parsers;

use Models\Model;

class CsvParser implements ParserInterface
{
    public function __construct(private string $filename, private array $headerMaps)
    {
    }
    public function parse(string $modelClass, array $summarizeBy): array
    {
        $handle = fopen($this->filename, "r");
        $headers = fgetcsv($handle);

        $summary = [];
        while ($data = fgetcsv($handle)) {
            // We'll make a new instance of a model and populate it with the data from the CSV row
            $model = $modelClass::make(array_combine($headers, $data), $this->headerMaps[$modelClass]);

            // Let's generate a hashed key based on the properties we want to summarize by
            $summaryValues = [];
            foreach ($summarizeBy as $property) {
                $summaryValues[] =$model->$property;
            }

            $summaryKey = md5(implode('|', $summaryValues));

            // Let's increment the summary count for the generated key
            if (!isset($summary[$summaryKey])) {
                $summary[$summaryKey] = ['count'=>0, 'values'=>$summaryValues];
            }

            $summary[$summaryKey]['count']++;
        }
        fclose($handle);

        return $summary;
    }
}
