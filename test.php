<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Test MAXY Page 1</title>
<style type="text/css">
*{font-family: sans-serif;}
</style>
</head>
<body>

<?php

require 'maxy.class.php';
require 'acb.class.php';

$arr = array
(
		array(1,0,5,0),
		array(2,-1,0,3),
		array(3,0,2,0),
		array(7,0,6,5)
);
$arr8 = array
(
		array(1,7,5),
		array(2,-1,2),
		array(3,0,2),
		array(7,2,6)
);
$arr2 = array
(
		array(2,5,6),
		array(1,6,7),
		array(1,2,3)
);

$arr3 = array
(
	array(1,2,3,-4,2),
	array(0,1,0,0,0),
	array(0,4,4,2,1),
	array(0,-5,5,1,4),
	array(0,1,0,-1,2)
);

$arr4 = array
(
		array(3,0,2),
		array(9,1,7),
		array(1,0,1)
);

$arr5 = array
(
		array(1,0,-2),
		array(-2,1,-3),
		array(-1,0,3)
);

$arr6 = array
(
		array(1,2,3),
		array(2,3,1),
		array(3,1,2)
);

$arr7 = array
(
		array(2,3,5),
		array(6,7,5),
		array(1,10,11)
);

//$check = $mxy->main_diagonal($arr);
//$sec = $mxy->sec_diagonal($arr);
//$trans = $mxy->get_transposed($arr);
//$opposite = $mxy->get_opposite($arr);
//

// */
?>

<form action="control.php" method="post">
<input type="hidden" name="a[0][0]" value="1">
<input type="hidden" name="a[0][1]" value="2">
<input type="hidden" name="a[1][0]" value="3">
<input type="hidden" name="a[1][1]" value="4">
<input type="hidden" name="q" value="get_json_file">
<input type="submit">
</form>

<?php 

$json = '{"0":{"0":"1","1":"2"},"1":{"0":"3","1":"4"}}';

//$j = $mxy->json2maxy($json);

//$mxy = new Maxy($arr2, $arr3);

//echo '<pre>';
$params = array
(
	"if i<j then i+2*j",
	//"if i>j then i-2/j",
	"if i==j then 55",
	//"if i==j then -i",
	//"if i>j then 0"
		
);

$acb = new Acb();
$x = $acb->anagram(10, array(2,3,2));

var_dump($x);

?>

</body>
</html>

