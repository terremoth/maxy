<?php
require_once 'maxy.class.php';

$maxy = new Maxy();

$q = $_POST['q'];
var_dump($_POST);
switch ($q) 
{
	case "size":
		$rows = $_POST['rows'];
		$cols = $_POST['cols'];
		$var = $_POST['let'];
		
		$matrix = $maxy->create($rows,$cols,$var);
		
		echo $matrix;
		
	break;
	
	case "get_json_file":
		
		if(isset($_POST['a']))
		{
			if(!empty($_POST['a']))
			{
				$arr = $_POST['a'];
				$maxy->get_json_file($arr);
			}
			else 
			{
				die("Error: The matrix is empty");
			}
		}
		else
		{
			die("Error: The matrix is not set!");
		}
		
	break;
		
	case "determinant":
		
		$arr = $_POST['a'];
		//print_r($arr);
		$result = $maxy->det($arr);
		echo $result;
		
	break;
	
	case "calc":
	
		$op = $_POST["operation"];
		$a= $_POST["a"];
		$b= $_POST["b"];
		
		switch ($op) 
		{
			case "sum":
				$matrix = $maxy->sum($a, $b);
				$new = $maxy->get_table($matrix, "all", TRUE);
				echo $new;
			break;
			
			case "sub":
				$matrix = $maxy->sub($a, $b);
				$new = $maxy->get_table($matrix, "all", TRUE);
				echo $new;
			break;
					
			case "div":
				$matrix = $maxy->div($a, $b);
				$new = $maxy->get_table($matrix, "all", TRUE);
				echo $new;
			break;
			
			case "mult":
				$matrix = $maxy->mult($a, $b);
				$new = $maxy->get_table($matrix, "all", TRUE);
				echo $new;
			break;
			
			default:
				;
			break;
		}
		
		
	default:
		;
	break;
}