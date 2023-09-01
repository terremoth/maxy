<?php

namespace Maxy\Contracts;

interface MatrixInterface
{
    public function __construct(array $array);
    public function __serialize(): array;
    public function __unserialize($data) : void;
    public function countRows(): int;
    public function getRow(int $rowNumber): array ;
    public function countColumns(): int;
    public function getColumn(int $columnNumber): array;
    public function toArray() : array;

}