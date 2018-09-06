<?php 

# maxy.class.php

/**
 * @name MA.XY. (Matrixy)
 * @package SAMF - Suíte de Aplicativos Matemática e Física
 * @subpackage Math
 * @category Math
 * @example /path/examples/
 * @since 2015-02-17  
 * @author Lucas Marques Dutra (dutr4@outlook.com)
 * @access Private
 * @copyright Copyright &copy; Lucas Marques Dutra - dutr4@outlook.com
 * @version 1.0
 * @license
 * @desc A huge class to work with infinite Math Bi-dimensional Matrices
 *
 */
//abstract 
class Maxy
{	
	
	/**
	 * @desc MA.XY. Software Version
	 * @var string
	 */
	const VERSION = "1.0";
	
	/**
	 * Number of Cols of a Matrix
	 * @var integer
	 */
	protected $Cols = NULL;
	
	/**
	 * Number of Rows of a Matrix
	 * @var integer
	 */
	protected $Rows = NULL;
	
	/**
	 * Order of a square Matrix
	 * @var integer
	 */
	protected $Order = NULL;
	
	/**
	 * @desc Matrices
	 * @var array
	 */
	protected $Matrices = array();
	
	/**
	 * @desc Group
	 * @var array
	 */
	protected  $Group = array();



	/**
	 * @desc Search for errors in arrays, Instances all the matrices and creates the Ma.XY. environment
	 * @param array $arr1
	 * @param array $arr2
	 * @return void
	 */
//	function __construct(array $arr1, $arr2 = false)
//	{
//		$this->check_matrix($arr1);
////		$this->check_matrix($arr2);
//		
////		var_dump($this->Matrices);
//		
//	
//	}

	
// GETTERS:
/*****************************************************************************************************************/
	
	/**
	 * Returns Software Version
	 * @return string
	 */
	function getVersion()
	{
		return self::VERSION;
	}
	
	function getCols($maxy_index)
	{
		return $this->Cols[$maxy_index];
	}
	
	function getRows($maxy_index)
	{
		return $this->Rows[$maxy_index];
	}
	
	function getOrder($maxy_index)
	{
		return $this->Order[$maxy_index];
	}
	
	function getMatrices($maxy_index) 
	{
		return $this->Matrices[$maxy_index];
	}
	
	function getGroup($maxy_index)
	{
		return $this->Group[$maxy_index];
	}
	
	
// SETTERS:
/*****************************************************************************************************************/

	
	protected function setCols($cols)
	{
		$this->Cols[] = $cols;
	}

	protected function setRows($rows)
	{
		$this->Rows[] = $rows;
	}

	protected function setOrder($order)
	{
		$this->Order[] = $order;
	}

	protected function setMatrices($matrices)
	{
		$this->Matrices[] = $matrices;
	}

	protected function setGroup($group)
	{
		$this->Group[] = $group;
	}
	
/****** Setting specifying the index: ****************************************************************************************/
	
	protected function setColsTo($maxy_index, $cols)
	{
		$this->Cols[$maxy_index] = $cols;
	}
	
	protected function setRowsTo($maxy_index, $rows)
	{
		$this->Rows[$maxy_index] = $rows;
	}
	
	protected function setOrderTo($maxy_index, $order)
	{
		$this->Order[$maxy_index] = $order;
	}
	
	protected function setMatricesTo($maxy_index, $matrices)
	{
		$this->Matrices[$maxy_index] = $matrices;
	}
	
	protected function setGroupTo($maxy_index, $group)
	{
		$this->Group[$maxy_index] = $group;
	}

/*****************************************************************************************************************/
		
	/**
	 * Check if the Matrix is valid and have no errors
	 * # Tested
	 * @param array $arr
	 * @return string
	 */
	function check_matrix($arr) 
	{
		if (is_array($arr)) 
		{
			$rows = count($arr);
			$columns = array();
			//echo $rows.' : ';
			for($i = 0; $i < $rows; $i++) // Start counting the rows and checking for possible errors
			{
				//echo $i.' - ';
				# Conta a quantidade de itens nas linhas p/ verificar se colunas == linhas;
				$quant = count($arr[$i]);
				
				$columns[$i] = $quant;
				
				if (is_array($arr[$i])) 
				{	
					for($j = 0; $j < $quant; $j++) // conta
					{
						$item = $arr[$i][$j];
						//var_dump($item);
						
						if (is_array($item))  
						{
							$this->getError(0, $i+1, $j+1);
						}
						elseif((empty($item) and $item !=0) and $item != '')
						{
							$this->getError(1, $i+1, $j+1);
						}
						elseif(!is_numeric($item)) 
						{
							$this->getError(2, $i+1, $j+1);
						}
						// If all itens verifications ends here, it's because all itens are okay :-)
					}
				}
				else 
				{
					$this->getError(3, $i+1);
				}
			}
			
			# Verify if $arr is a square Matrix or not, by checking the same quantity of columns
			for ($l = 0; $l < count($columns); $l++) 
			{
				if (isset($columns[$l+1]))
				{
					if($columns[$l] != $columns[$l+1])
					{
						$this->getError(4);
					}
				}
			}
			
			$this->setMatrices($arr);
			$this->setCols($columns[0]);
			$this->setRows($rows);
			
			return "Success";
		}
		else 
		{
			$this->getError(7);
		}
	}
	
	/**
	 * Returns Matrix Order
	 * # Tested
	 * @param array $arr
	 * @return string|number
	 */
	function matrix_order($maxy_index) 
	{
		$check = $this->check_square_matrix($maxy_index); 
		
		if($check === true)
		{
			return $check;
		}
		else 
		{
			die("Error:\n");
		}
		
	}
	
	/**
	 * Checks if a Matrix is Square
	 * @param array $arr
	 * @return string
	 */
	function check_square_matrix($maxy_index) 
	{
		# Verify if number of rows == number of cols
			
		if ($this->getCols($maxy_index) == $this->getRows($maxy_index))
		{
			$this->setOrder($this->getRows($maxy_index)); //or = $this->Cols, does not matter
			return true;
		}
		elseif ($this->getCols($maxy_index) > $this->getRows($maxy_index))
		{
			$this->getError(5);
		}
		elseif ($this->getCols($maxy_index) < $this->getRows($maxy_index))
		{
			$this->getError(6);
		}
	}
	
	/**
	 * Returns the Main Diagonal of a Square Matrix
	 * # Tested
	 * @param array $arr
	 * @return string|array
	 */
	function main_diagonal($arr) 
	{
		$order = $this->getOrder();
		
		if (!is_numeric($order)) 
		{
			return $order;
		}
		
		$md = array();
		
		for ($i = 0; $i < $order; $i++) 
		{
			$md[$i] = $arr[$i][$i];
		}
		
		return $md;
	}
	
	/**
	 * Returns the Secondary Diagonal of a Square Matrix
	 * # Tested
	 * @param array $arr
	 * @return string|array
	 */
	function sec_diagonal($arr)
	{
		$order = $this->getOrder();
	
		if (!is_numeric($order))
		{
			return $order;
		}
	
		$secd = array();
	
		for ($i = 0; $i < $order; $i++)
		{
			$secd[$i] = $arr[$i][$order-1-$i];
		}
	
		return $secd;
	}
	
	/**
	 * Returns a transposed bidimensional Matrix
	 * # Tested
	 * @param array $arr
	 * @return string|array
	 */
	function get_transposed($arr) 
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
		
		$new_matrix = array(); // creates the new matrix
		
		for ($i = 0; $i < $this->Cols; $i++) // Transposing ... 
		{
			$new_matrix[$i] = array(); // Creates bidimension
			
			for ($j = 0; $j < $this->Rows; $j++) 
			{
				$new_matrix[$i][$j] = $arr[$j][$i]; //inverting Rows to Columns
			}
		}
		
		return $new_matrix;
	}
	
	/**
	 * Returns an Opposite Matrix
	 * # Tested
	 * @param array $arr
	 * @return string|array
	 */
	function get_opposite($arr) 
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
		
		for ($i = 0; $i < $this->Rows; $i++) // Verifying all elements by stariting with rows
		{
			$new_matrix[$i] = array(); 
			
			for ($j = 0; $j < $this->Rows; $j++) // Verifying item by item
			{
				$new_matrix[$i][$j] = (-1) * $arr[$i][$j]; //inverting Rows to Columns
			}
		}
		
		return $new_matrix;
	}
	
	function get_json_file($arr)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$matriz = json_encode($arr, JSON_FORCE_OBJECT);
		//$matriz = $matriz->result->posts;
		$name = 'matriz_'.date("YmdHis").'.json'; //Horário padronizado ISO-8601
		$handle = fopen($name, 'w');
		fwrite($handle, $matriz);
		fclose($handle);
		
		header('Content-Type: application/json');
		header('Content-Disposition: attachment; filename='.basename($name));
		header('Expires: 0');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($name));
		readfile($name);
		exit();
		
	}
	
	function get_json($arr)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$matriz = json_encode($arr, JSON_FORCE_OBJECT);
		
		return $matriz;
	}
	
	function json2array($json)
	{
		$matrix = json_decode($json, true);
		
		$check = $this->check_matrix($matrix);
		
		if ($check != "Success")
		{
			return $check;
		}
		else 
		{
			return $matrix;
		}
		
	}
	
	function maxyResolver($maxy_file_contents)
	{
		
	
	}
	
	
	function get_csv_file($arr)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
		
		$linha = '';
		
		for($i=0; $i < $this->Rows; $i++)
		{
			for ($j = 0; $j < $this->Cols; $j++)
			{
				if ($j == ($this->Cols-1) && $i == ($this->Rows-1)) 
				{
					$linha .= $arr[$i][$j];
				}
				else 
				{
					$linha .= $arr[$i][$j].",";
				}
			}
			
			if ($j == ($this->Cols-1) && $i == ($this->Rows-1)) 
			{
				$linha .= '';
			}
			else 
			{
				$linha .= "\n";
			}
		}
		
		$name = 'matrix_'.date("YmdHis").'.csv'; //Default time ISO-8601
		$handle = fopen($name, 'w');
		fwrite($handle, $linha);
		fclose($handle);
	
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($name));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($name));
		readfile($name);
		exit();
	}
	
	/**
	 * 
	 * @param array $arr
	 * @return string
	 */
	function get_csv($arr)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$linha = '';
	
		for($i=0; $i < $this->Rows; $i++)
		{
			for ($j = 0; $j < $this->Cols; $j++)
			{
				if ($j == ($this->Cols-1) && $i == ($this->Rows-1)) 
				{
					$linha .= $arr[$i][$j];
				}
				else 
				{
					$linha .= $arr[$i][$j].",";
				}
			}
			
			if ($j == ($this->Cols-1) && $i == ($this->Rows-1)) 
			{
				$linha .= '';
			}
			else 
			{
				$linha .= "\n";
			}
		}
		
		return $linha;
	}
	
	function csv_to_matrix($path_file="matrix.csv")
	{
		if (is_file($path_file))
		{
			$arr = file_get_contents($path_file);
		
			for($i=0; $i < count($arr); $i++)
			{
				$arr[$i] = explode(",", $arr[$i]);
			}
				
			$check = $this->check_matrix($arr);
		
			if ($check != "Success")
			{
				return $check;
			}
				
			return $arr;
		}
		else
		{
			return "Error 16: The file specified does not exist!";
		}
	
	}
	
	
	function get_spaced($arr)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$linha = '';
	
		for($i=0; $i < $this->Rows; $i++)
		{
			for ($j = 0; $j < $this->Cols; $j++)
			{
				if ($j == ($this->Cols-1) && $i == ($this->Rows-1))
				{
					$linha .= $arr[$i][$j];
				}
				else
				{
					$linha .= $arr[$i][$j]." ";
				}
			}
				
			if ($j == ($this->Cols-1) && $i == ($this->Rows-1))
			{
				$linha .= '';
			}
			else
			{
				$linha .= "\n";
			}
		}
	
		return $linha;
	}

	
	function spaced_to_matriz($str_arr)
	{
		$arr = file_get_contents($path_file); // parei aqui

		for($i=0; $i < count($arr); $i++)
		{
			$arr[$i] = explode(",", $arr[$i]);
		}

		$check = $this->check_matrix($arr);

		if ($check != "Success")
		{
			return $check;
		}

		return $arr;
	}
	
	
	
	function get_table($arr, $border="side", $inputed=FALSE)
	{
		$check = $this->check_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
		
		
		$table = '<style id="matrix_styler">'."\n";
		switch ($border) 
		{
			case $border=="all":
				
				$table .='
					#matrix-table-result, #matrix-table-result td, #matrix-table-result tr
					{ 
						border:1px solid black;
					}'."\n";
				
			break;
			
			case $border=="side":
			default:	
				
				$table .='#matrix-table-result {border-left:1px solid black;border-right:1px solid black;}'."\n";
			break;
			
			case $border=="none":
				$table .= ''."\n";
			break;
		}
		$table .='</style>'."\n";
		
		$table .= "\n".'<table id="matrix-table-result">'."\n";
		
		for($i=0; $i < $this->Rows; $i++)
		{
			$table .= "\t<tr>\n";
			
			for ($j = 0; $j < $this->Cols; $j++)
			{	
				if ($j == 0) 
				{
					if ($inputed == TRUE) 
					{
						$table .= "\t\t".'<td><input type="text" required="required" style="width:40px;" id="a['.$i.']['.$j.']" name="a['.$i.']['.$j.']" value="'.$arr[$i][$j].'"></td>';
					}
					else 
					{
						$table .= "\t\t".'<td>'.$arr[$i][$j].'<td>';
					}
					
				}
				elseif($j == $this->Cols-1)
				{
					if ($inputed == TRUE) 
					{
						$table .= '<td><input type="text" required="required" style="width:40px;" id="a['.$i.']['.$j.']" name="a['.$i.']['.$j.']" value="'.$arr[$i][$j].'"></td>'."\n";
					}
					else 
					{
						$table .= '<td>'.$arr[$i][$j].'<td>'."\n";
					}
				}
				else 
				{	
					if ($inputed == TRUE) 
					{
						$table .= '<td><input type="text" required="required" style="width:40px;" id="a['.$i.']['.$j.']" name="a['.$i.']['.$j.']" value="'.$arr[$i][$j].'"></td>';
					}
					else 
					{
						$table .= '<td>'.$arr[$i][$j].'</td>';
					}
				}
			}
			
			$table .= "\t</tr>\n";
		}
		
		$table .= "</table>\n";
		
		return $table;
	}
	
	function check_equal_size($arr1, $arr2) 
	{
		$check = $this->check_matrix($arr1);
	
		if ($check != "Success")
		{
			return $check;//exit();
		}
		
		$m1r = $this->Rows;
		$m1c = $this->Cols;
		
		$check = $this->check_matrix($arr2);
		
		if ($check != "Success")
		{
			return $check;
		}
		
		$m2r = $this->Rows;
		$m2c = $this->Cols;
		
		if ($m1r == $m2r && $m1c == $m2c) 
		{
			return TRUE;
		}
		else 
		{
			return "Error 09: The Matrices does not have the same size: a".$m1r.$m1c." and b".$m2r.$m2c;
		}
		
	}
	
	// Daqui para baixo o barato fica louco!
	
	function sum($arr1, $arr2) 
	{
		$check = $this->check_equal_size($arr1, $arr2);
		if ($check !== TRUE) 
		{
			return $check;
		}
		
		$new_matrix = array();
		
		for ($i = 0; $i < $this->Rows; $i++) 
		{
			$new_matrix[$i] = array();
			
			for ($j = 0; $j < $this->Cols; $j++) 
			{
				$new_matrix[$i][$j] = $arr1[$i][$j] + $arr2[$i][$j];
			}
		}

		return $new_matrix;
	}
	
	function sub($arr1, $arr2)
	{
		$check = $this->check_equal_size($arr1, $arr2);
	
		if ($check !== TRUE)
		{
			return $check;
		}
	
		$new_matrix = array();
		for ($i = 0; $i < $this->Rows; $i++)
		{
			$new_matrix[$i] = array();
			
			for ($j = 0; $j < $this->Cols; $j++)
			{
				$new_matrix[$i][$j] = $arr1[$i][$j] - $arr2[$i][$j];
			}
		}
	
		return $new_matrix;
	}
	
	function check_opost_size($arr1, $arr2)
	{
		$check = $this->check_matrix($arr1);
	
		if ($check != "Success")
		{
			return $check;
		}
		
		$m1r = $this->Rows;
		$m1c = $this->Cols;
		
		$this->Group[0] = array(0=>$m1r, 1=>$m1c);
		
		$check = $this->check_matrix($arr2);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$m2r = $this->Rows;
		$m2c = $this->Cols;
		
		$this->Group[1] = array(0=>$m2r, 1=>$m2c);
		
		if ($m1r == $m2c && $m1c == $m2r)
		{
			return TRUE;
		}
		else
		{
			return "Error 10: The Matrices does not have the opost size: a".$m1r.$m1c." and b".$m2r.$m2c;
		}
	}
	
	function mult($arr1, $arr2)
	{
		$check = $this->check_opost_size($arr1, $arr2);
	
		if ($check !== TRUE) 
		{
			return $check;
		}

		$new_matrix = array();
		
		for ($i = 0; $i < $this->Group[0][0]; $i++) // Counting and passing through the rows..
		{
			$new_matrix[$i] = array();
			
			for ($j = 0; $j < $this->Group[1][1]; $j++) 
			{
				$acumula = 0;
				$new_matrix[$i][$j] = array();
				
				for ($k = 0; $k < $this->Group[0][1]; $k++)
				{
					$acumula = $acumula + $arr1[$i][$k] * $arr2[$k][$j];
				}
				
				$new_matrix[$i][$j] = $acumula;
			}
		}
		
		return $new_matrix;
	}
	
	function div($arr1, $arr2)
	{
		//$check = $this->check_opost_size($arr1, $arr2);
	
		if ($this->check_opost_size($arr1, $arr2) != TRUE)
		{
			return $check;
		}
		
		$new_matrix = array();

		$arr2 = $this->getInverse($arr2);
		
		for ($i = 0; $i < $this->Group[0][0]; $i++) // Counting and passing through the rows..
		{
			$new_matrix[$i] = array();
				
			for ($j = 0; $j < $this->Group[1][1]; $j++)
			{
				$accumulate = 0;
				$new_matrix[$i][$j] = array();
	
				for ($k = 0; $k < $this->Group[0][1]; $k++)
				{
					$accumulate = $accumulate + $arr1[$i][$k] * $arr2[$k][$j];
				}
	
				$new_matrix[$i][$j] = $accumulate;
			}
		}
	
		return $new_matrix;
	}
	
	function create($rows=1, $cols=1, $field='a', $complete_table=false) 
	{
		$matrix = '';
		
		if ($complete_table == true) 
		{
			$matrix .= '<table>'."\n";
		}
		
		for ($i = 0; $i < $rows; $i++) 
		{
			$matrix .= '<tr>'."\n";
			
			for ($j = 0; $j < $cols; $j++) 
			{
				$matrix .= '<td><input type="text" name="'.$field.'['.$i.']['.$j.']" style="width:40px;" id="'.$field.'['.$i.']['.$j.']" required="required"></td>'."\n";
			}
			
			$matrix .= '</tr>'."\n";
		}
		
		if ($complete_table == true)
		{
			$matrix .= '</table>'."\n";
		}
		
		return $matrix;
	}
	
	
	function det1($arr) 
	{
		$check = $this->check_square_matrix($arr);
		
		if ($check != "Success")
		{
			return $check;
			
		}
		elseif($this->Order != 1) 
		{
			return "Error 11: The Matrix must be in 1st order.";
		}
		else 
		{
			//Unique
			$det = $arr[0][0];
			
			return $det;
		
		}
	}
	
	function det2($arr) 
	{
		$check = $this->check_square_matrix($arr);
		
		if ($check != "Success")
		{
			return $check;
			
		}
		elseif($this->Order != 2) 
		{
			return "Error 12: The Matrix must be in 2nd order.";
		}
		else 
		{
			//Main - Secondary
			$det = ($arr[0][0] * $arr[1][1]) - ($arr[0][1] * $arr[1][0]);
			
			return $det;
		
		}
	}
	
	
	function det3($arr)
	{
		$check = $this->check_square_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
			
		}
		elseif($this->Order != 3) 
		{
			return "Error 13: The Matrix must be in 3rd order.";
		}
		else 
		{
			//Main
			$dp  = $arr[0][0] * $arr[1][1] * $arr[2][2];
			$dp += $arr[0][1] * $arr[1][2] * $arr[2][0];
			$dp += $arr[0][2] * $arr[1][0] * $arr[2][1];
	
			//Secondary
			$sec  = $arr[0][2] * $arr[1][1] * $arr[2][0]; //ok
			$sec += $arr[0][0] * $arr[1][2] * $arr[2][1]; //ok
			$sec += $arr[0][1] * $arr[1][0] * $arr[2][2]; //ok
			
			$det = $dp - $sec; // Main - Secondary
			return $det;
		
		}
	}
	
	function quick_less_complem($arr)
	{
		$check = $this->check_square_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		array_shift($arr); // Erases first row
	
		for ($i = 0; $i < count($arr); $i++)
		{
			array_shift($arr[$i]); // erases first elements of each row
		}
	
		return $arr;
	}
	
	function less_complem($arr, $iA, $jA)
	{
		$check = $this->check_square_matrix($arr);
	
		if ($check != "Success")
		{
			return $check;
		}
	
		$horizontal_size = count($arr);
		
		for ($i = 0; $i < $horizontal_size; $i++) 
		{
			if ($i == $iA) 
			{
				unset($arr[$i]);
			}
			else
			{
				$vertical_size = count($arr[$i]);
				
				for ($j = 0; $j < $vertical_size; $j++) 
				{
					if ($j == $jA) 
					{
						unset($arr[$i][$j]);
					}
				}
			}
		}

		$new_matrix1 = array_values($arr);
		$new_matrix2 = $this->_organize($new_matrix1);
		$det = $this->det($new_matrix2);
		
		return $det;
	}
	
	/**
	 * Organizes the matrices positions
	 * @param array $arr
	 * @return array
	 */
	private function _organize($arr) 
	{
		$new_matrix = array();
		$size = count($arr);
		
		for ($i = 0; $i < $size; $i++) 
		{
			$new_matrix[$i] = array_values($arr[$i]);
		}
		
		return $new_matrix;
	}
	
	function det($arr) 
	{
		$check = $this->check_square_matrix($arr);
		
		if ($check != "Success")
		{
			return $check;
		}
		
		$size = $this->Order;
		
		
		switch ($size) 
		{
			case 1:
				return $this->det1($arr);
			break;
			
			case 2:
				return $this->det2($arr);
			break;
			
			case 3:
				return $this->det3($arr);
			break;
				
			default:
				return $this->laplace($arr);
			break;
		}
		
	}
	
	function laplace($arr,$fila="i=0") 
	{
		/*
		$x = explode("=", $fila);
		
		switch ($x[0]) 
		{
			case "i":
				;
			break;
			
			case "j":
				;	
			break;
			
			default:
				;
			break;
		}
		
		*/
		$size = count($arr[0]);
		
		$det = 0;
		for ($j = 0; $j < $size; $j++) 
		{
			$det += $arr[0][$j] * $this->cofactor($arr, 0, $j);
		}
		
		return $det;
	}
	
	
	function cofactor($arr, $i, $j) 
	{
		# Aij = (-1)^i+j * less_complem($arr, $i, $j);
		
		$check = $this->check_square_matrix($arr);
		
		if ($check != "Success")
		{
			return $check;
		}
		
		$value = pow(-1, $i+$j) * $this->less_complem($arr, $i, $j);
		
		return $value;
	}
	
	function unitMatrix($size=1) 
	{
		
		$matrix = array();
		
		for ($i = 0; $i < $size; $i++) 
		{
			$matrix[$i] = array();
			
			for ($j = 0; $j < $size; $j++) 
			{
				if ($j == $i) 
				{
					$matrix[$i][$j] = 1;
				}
				else 
				{
					$matrix[$i][$j] = 0;
				}
			}
			
		}
		
		return $matrix;
	}
	
	function import_maxy($csv_file_contents) 
	{
		$file = $csv_file_contents; # CSV Maxy file contents
		unset($csv_file_contents);
		
		$count = count($file);
		$matrices = array();
		$calc = NULL;
		
		for ($i = 0; $i < $count; $i++) // Number the file rows
		{
			if ($i%2 == 1) // Verify if the row is a matrix or command to sum, div, etc... If it is equal 1, it is a command, else is a matrix
			{
				$lastcmd = trim($file[$i]);
			}
			else // Will be a row with a Matrix
			{
				$rows = explode("|", $file[$i]); // Matrices Rows
				
				$matrices[$i] = array();
				
				for ($j = 0; $j < count($rows); $j++) 
				{
					$mx = explode(",", $rows[$j]);
					$matrices[$i][$j] = $mx; 
				}
				
				if ($i != 0) // If is not the first row, then it will star to calculate
				{
					if ($lastcmd == "sum") 
					{
						if ($calc != NULL) 
						{
							$calc = $this->sum($calc, $matrices[$i-2]);
						}
						else
						{

							$calc = $this->sum($matrices[$i-2], $matrices[$i]);
						}
					}
					elseif ($lastcmd == "sub")
					{
						if ($calc != NULL)
						{
							$calc = $this->sub($calc, $matrices[$i]);
						}
						else
						{
							$calc = $this->sub($matrices[$i-2], $matrices[$i]);
						}
					}
					elseif ($lastcmd == "mult")
					{
						if ($calc != NULL)
						{
							$calc = $this->mult($calc, $matrices[$i]);
						}
						else
						{
							$calc = $this->mult($matrices[$i-2], $matrices[$i]);
						}
					}
					elseif ($lastcmd == "div")
					{
						if ($calc != NULL)
						{
							$calc = $this->div($calc, $matrices[$i]);
						}
						else
						{
							$calc = $this->div($matrices[$i-2], $matrices[$i]);
						}
					}
					else 
					{
						return "Error 14: The file is not writed in the default way! Wrong command given: ".$lastcmd;
					}
				}// end of if of calculation
			}// end of Else with matrix
		}// end of For $i
		
		return $calc;
		
	}
	
	/**
	 * 
	 * @param array $arr1
	 * @param array $arr2
	 * @return boolean
	 */
	function is_inverse($arr1,$arr2)
	{
		$new_matrix = $this->mult($arr1, $arr2);
		$unit = $this->unitMatrix(count($new_matrix));
		
		if ($this->is_equal($new_matrix, $unit)) 
		{
			return TRUE;
		}
		else 
		{
			return FALSE;
		}
	}
	
	/**
	 * Verify if two matrices has the same order and the same elements
	 * @param unknown $arr1
	 * @param unknown $arr2
	 * @return string|boolean
	 */
	function is_equal($arr1, $arr2) 
	{
		$check = $this->check_square_matrix($arr1);
		
		if ($check != "Success")
		{
			return $check;
		}
		
		$order1 = $this->Order;
		
		$check = $this->check_square_matrix($arr2);
		
		if ($check != "Success")
		{
			return $check;
		}
		
		$order2 = $this->Order;
		
		if ($order1 != $order2) 
		{
			return 'Error 15: The Matrices are not equal! First is order '.$order1.' and second is order '.$order2;
		}
		
		for ($i = 0; $i < $this->Order; $i++)
		{
			for ($j = 0; $j < count($arr2); $j++) 
			{
				if ($arr1[$i][$j] != $arr2[$i][$j]) 
				{
					return FALSE;
				}
			}
		}
		
		return TRUE;
	}
	
	// The treta begins again! // 2015-07-05
	/**
	 * Gets the inverse of a matrix
	 * @param array $arr
	 * @return string|array
	 */
	function getInverse($arr) 
	{
		// Verify if matrix determinant is equal zero, if it is, there are no inverse
		
		$det = $this->det($arr);
		
		if ($det == 0) 
		{
			return "This Matrix has no inverse!";
		}
		else
		{
			$adj = $this->get_adjoint($arr); // adjoint matrix
			
			$new_matrix = array();
			
			for ($i = 0; $i < count($adj); $i++) 
			{
				for ($j = 0; $j < count($adj); $j++) 
				{
					$new_matrix[$i][$j] = $adj[$i][$j]/$det;
				}
			}
			
			return $new_matrix;
		}
		
	}
	
	function get_adjoint($arr) 
	{
		$cofactorMatrix = $this->createCofactorMatrix($arr);
		return $this->get_transposed($cofactorMatrix);
	}
	
	/**
	 * Creates a cofactor matrix
	 * @param array $arr
	 * @return array
	 */
	function createCofactorMatrix($arr) 
	{
		$new_matrix = array();
		
		for ($i = 0; $i < count($arr); $i++) 
		{
			for ($j = 0; $j < count($arr[$i]); $j++) 
			{
				$new_matrix[$i][$j] = $this->cofactor($arr, $i, $j);	
			}
		}
		
		return $new_matrix;
	}
	
	
	function generateMaxy($matrixOrder=1, $params=array()) 
	{
		/* Param model 
		 * Example:
		 * array
		 * (
		 * 		"if i<j then i+2*j",
		 * 		"if i==j then -i"
		 * 		"if i>j then 0"
		 * ); 
		 * 
		 * Note: If you use a sentence like: "if i>j then 0" and then use: "if i>j then 1", it will override to 1 if i>j
		 */
		
		$quantParams = count($params);
		$newMatrix = array();
		
		for ($i = 0; $i < $matrixOrder; $i++) 
		{
			for ($j = 0; $j < $matrixOrder; $j++) 
			{
				# Main function part
				// Using example: if i<j then i+2*j
				
				for ($n = 0; $n < $quantParams; $n++) 
				{
					$parts = $this->_substituteIJ($params[$n], $i, $j);
					$part1 = $parts[0];
					
					eval("\$result = $part1;");

					if ($result) 
					{	
						$part2 = $parts[1];
						eval("\$result2 = $part2;");
						$newMatrix[$i][$j] = $result2;
					}
				}
			}
		}
		
		return $this->_fill_with_zeros($newMatrix, $matrixOrder);
	}
	
	
	private function _substituteIJ($param, $i, $j, $adc=null) 
	{
		$cleaned = explode("if ", $param);
		
		$search  = ["i", "j"];
		$replace = [$i+1 ,  $j+1];
		
		$substitute = str_replace($search, $replace, $cleaned[1]);
		$semi_final = explode(" then ", $substitute);
		
		return $semi_final;
	}
	
	private function _fill_with_zeros($arr, $order=1)
	{
		for ($i = 0; $i < $order; $i++) 
		{
			for ($j = 0; $j < $order; $j++) 
			{
				if (!isset($arr[$i][$j]))
				{
					$arr[$i][$j] = 0;
				}
			}
		}
		
		return $arr;
	}
	
	/**
	 * @desc Creates a random matrix
	 * @param integer $lines
	 * @param integer $cols
	 * @param integer $min_valor
	 * @param integer $max_valor
	 * @param integer $decimals_digits
	 * @return array
	 */
	function randomMaxy($lines=3, $cols=3, $min_valor=1, $max_valor=10, $decimals_digits=1) 
	{
		$new_matrix = array();
		
		for ($i = 0; $i < $lines; $i++) 
		{
			for ($j = 0; $j < $cols; $j++) 
			{
				if ($decimals_digits == 1) 
				{
					$new_matrix[$i][$j] = mt_rand($min_valor, $max_valor);
				}
				else 
				{
					$new_matrix[$i][$j] = $this->_float_rand($min_valor, $max_valor, $decimals_digits);
				}
				
			}
		}
		
		return $new_matrix;
	}
	
	
	/**
	 * Generate Float Random Number
	 *
	 * @param float $Min Minimal value
	 * @param float $Max Maximal value
	 * @param int $round The optional number of decimal digits to round to. default 0 means not round
	 * @return float
	 */
	protected function _float_rand($Min, $Max, $round=0)
	{
		//validate input
		if($Min>$Max) 
		{ 
			$min = $Max; 
			$max = $Min;
		}
		else
		{ 
			$min=$Min; 
			$max=$Max; 
		}
		
		$randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);
			
		if($round > 0)
		{
			$randomfloat = round($randomfloat,$round);
		}
	
		return $randomfloat;
	}
	
	
	protected function getError($number, $info1=null, $info2=null) 
	{
		ini_set("display_errors", 1);
		
		$errors = 
		[
			/*0 */	'Element at row '.$info1.' and column '.$info2.' is multidimensional, only bidimensional matrices are permitted',
			/*1 */	'Element at row '.$info1.' and column '.$info2.' cannot be empty!',
			/*2 */	'Element at row '.$info1.' and column '.$info2.' is not numeric!',
			/*3 */	'Matrix row number '.$info1.' is not an Array',
			/*4 */	'Is not a Matrix! (Not retangular)',
			/*5 */	'Matrix is not square: There are more columns than rows!',
			/*6 */	'Matrix is not square: There are more rows than columns',
			/*7 */ 	'It is not a matrix form',
			/*8 */ 	'The Matrices does not have the same size: a'.$info1.' and b'.$info2,
			/*9 */	'The Matrices does not have the opost size: a'.$info1.' and b'.$info2,
			/*10*/	'The Matrix must be in 1st order.',
			/*11*/	'The Matrix must be in 2nd order.',
			/*12*/	'The Matrix must be in 3rd order.',
			/*13*/	'The file is not writed in the default way! Wrong command given: '.$info1,
			/*14*/	'The Matrices are not equal! First is order '.$info1.' and second is order '.$info2,
			/*15*/	'The file specified does not exist!',
				
		];
		
		$message = 'Error '.$number.': '.$errors[$number];
		
		die($message);
	}
	
}

?>