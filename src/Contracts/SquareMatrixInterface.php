<?php

namespace Maxy\Contracts;

interface SquareMatrixInterface
{
    public function __construct();
    public function getOrder() : int;
}