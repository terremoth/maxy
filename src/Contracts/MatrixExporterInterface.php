<?php

namespace Maxy\Contracts;

interface MatrixExporterInterface
{
    public function saveFile($path) : void;
    public function __toString() : string;
}