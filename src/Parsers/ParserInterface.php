<?php

namespace Parsers;

use Services\Counter;

interface ParserInterface
{
    public function __construct(string $filename, array $headerMaps, Counter $counter);
    public function parse(string $modelClass, array $summarizeBy): array;
}
