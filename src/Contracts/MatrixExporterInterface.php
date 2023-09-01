<?php

namespace Maxy\Contracts;

interface MatrixExporterInterface
{
    public function saveFile(string $path) : bool;
    public function __toString() : string;
}
