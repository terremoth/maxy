<?php

ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);

//require_once './maxy.class.php';
require_once 'Maxy.php';

$arr1 = array(
	[1,2,3],
	[4,3,6],
	[7,8,9]
);


$maxy = new \Maxy\Maxy($arr1);
echo '<pre>';
print_r($maxy->get());
print_r($maxy->opposite());
