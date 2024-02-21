<?php

namespace Parsers;

interface ParserInterface
{
    public function __construct(string $filename, array $headerMaps);
    public function parse(string $modelClass, array $summarizeBy): array;
}
