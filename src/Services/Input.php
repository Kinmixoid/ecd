<?php

namespace Services;

class Input
{
    private string $source;
    private string $destination;

    public function __construct($argv)
    {
        if (!isset($argv[1])) {
            throw new \Exception('Source argument is required');
        }
        if (!isset($argv[2])) {
            throw new \Exception('Destination argument is required');
        }

        $this->source = $argv[1];
        $this->destination = $argv[2];
    }

    public function getSource(): string
    {
        return $this->source;
    }
    public function getDestination(): string
    {
        return $this->destination;
    }
}
