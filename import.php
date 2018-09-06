<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Import Matrix</title>
<style type="text/css">
*{font-family: sans-serif;} 
#matrix-table-result, #matrix-table-result td, #matrix-table-result tr
{ 
	border:1px solid black;
}
</style>

</head>
<body>
<h2>Import CSV Maxy File to calculate</h2>
<form action="import.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" accept="text/csv"><br><br>
<input type="submit">
</form>

<?php 

if (isset($_FILES["file"]) && !empty($_FILES['file'])) 
{
	$file = file($_FILES["file"]["tmp_name"]);
	
	//print_r($file).'<br><br>';
	
	require_once 'maxy.class.php';
	
	$maxy = new Maxy();
	
	$result = $maxy->import_maxy($file);
	
	print_r($result);
}

?>
</body>
</html>