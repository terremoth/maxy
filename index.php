<?php

require_once __DIR__.'/vendor/autoload.php';

use Maxy\Matrix;

$arr = [
    [1,2,3],
    [4,5,6],
    [7,8,9],
    [10,11,12],
];

$matrix = new Matrix($arr);
echo serialize($matrix);