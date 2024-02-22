<?php

use Parsers\ParserInterface;
use Models\Product;

class App
{
    private array $data;
    public function __construct(
        private Services\Input $input,
        private Services\Configuration $configuration,
        private Services\Counter $counter,
    ) {
    }

    public function run(): void
    {
        //make parser based on the input file
        $parser = $this->makeParser($this->input->getSource());

        //we'll need to parse input and summarize it in a single step
        //as loading the entire file into memory might not be possible
        $this->data = $parser->parse(Product::class, $this->configuration->get('output.group_by'));


        $this->saveData($this->input->getDestination());
    }

    private function saveData($outputFile): void
    {
        //set full path to the output file
        $outputFile = $this->configuration->get('output.location').'/'.$outputFile;

        $handle = fopen($outputFile, "w");

        //write the header with all "group by" fields and the count
        fputcsv($handle, [...$this->configuration->get('output.group_by'),'count']);
        foreach ($this->data as $row) {
            fputcsv($handle, [...$row['values'], $row['count']]);
        }

        fclose($handle);
    }

    private function makeParser($filename): ParserInterface
    {
        //we need to know extension of the file to know which parser to use
        $filename =$this->configuration->get('input.location').'/'.$filename;
        if (!file_exists($filename)) {
            throw new \Exception('Source File not found');
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        //we can get parser for a given extension from the config file
        $parserClass = $this->configuration->get("input.formats.$extension.parser");

        if (!$parserClass) {
            throw new \Exception('Parser not found');
        }

        // instantiate the parser with given filename and header maps from the config  and return it
        return new $parserClass(
            $filename,
            $this->configuration->get("input.formats.$extension.header-maps"),
            $this->counter
        );
    }
}
