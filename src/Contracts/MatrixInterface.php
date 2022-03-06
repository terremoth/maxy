<?php

namespace Maxy\Contracts;

interface MatrixInterface
{
    public function __construct();
    public function __serialize(): array;
    public function getRows(): int;
    public function getRow(): array;
    public function getColumns(): int;
    public function getColumn(): array;
    public function toArray() : array;

}