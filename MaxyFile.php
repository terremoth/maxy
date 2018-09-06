<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of maxy_fle
 *
 * @author fedudubili
 */
class MaxyFile 
{
	public function jsonFile($arr) 
    {
		$matriz = json_encode($arr);
		$name = 'matriz_' . date("YmdHis") . '.json'; //Horário padronizado ISO-8601
		$handle = fopen($name, 'w');
		fwrite($handle, $matriz);
		fclose($handle);
		
		header('Content-Type: application/json');
		header('Content-Disposition: attachment; filename=' . basename($name));
		header('Expires: 0');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($name));
		readfile($name);
		exit();
	}

	public function json($arr) 
    {
		$matrix = json_encode($arr);
		return $matrix;
	}

	public function json2array($json) 
    {
		$matrix = json_decode($json, true);

	}

	public function maxyResolver($maxy_file_contents) 
    {
		return $maxy_file_contents;
	}

	public function get_csv_file($arr) 
    {
		$linha = '';

		for ($i = 0; $i < $this->Rows; $i++) {
			for ($j = 0; $j < $this->Cols; $j++) {
				if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
					$linha .= $arr[$i][$j];
				} else {
					$linha .= $arr[$i][$j] . ",";
				}
			}

			if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
				$linha .= '';
			} else {
				$linha .= "\n";
			}
		}

		$name = 'matrix_' . date("YmdHis") . '.csv'; //Default time ISO-8601
		$handle = fopen($name, 'w');
		fwrite($handle, $linha);
		fclose($handle);

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($name));
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
	public function get_csv($arr) 
    {
		$linha = '';

		for ($i = 0; $i < $this->Rows; $i++) {
			for ($j = 0; $j < $this->Cols; $j++) {
				if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
					$linha .= $arr[$i][$j];
				} else {
					$linha .= $arr[$i][$j] . ",";
				}
			}

			if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
				$linha .= '';
			} else {
				$linha .= "\n";
			}
		}

		return $linha;
	}

	function csv_to_matrix($path_file = "matrix.csv") 
    {
		if (is_file($path_file)) {
			$arr = file_get_contents($path_file);

			for ($i = 0; $i < count($arr); $i++) {
				$arr[$i] = explode(",", $arr[$i]);
			}

			$check = $this->check_matrix($arr);

			if ($check != "Success") {
				return $check;
			}

			return $arr;
		} else {
			return "Error 16: The file specified does not exist!";
		}
	}

	function get_spaced($arr) 
    {
		$linha = '';

		for ($i = 0; $i < $this->Rows; $i++) {
			for ($j = 0; $j < $this->Cols; $j++) {
				if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
					$linha .= $arr[$i][$j];
				} else {
					$linha .= $arr[$i][$j] . " ";
				}
			}

			if ($j == ($this->Cols - 1) && $i == ($this->Rows - 1)) {
				$linha .= '';
			} else {
				$linha .= "\n";
			}
		}

		return $linha;
	}

	function spaced_to_matriz($str_arr) {
		$arr = file_get_contents($path_file); // parei aqui

		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i] = explode(",", $arr[$i]);
		}

		return $arr;
	}

	function table($arr, $border = "side", $inputed = FALSE) 
    {

		$table = '<style id="matrix_styler">' . "\n";
		switch ($border) {
			case $border == "all":

				$table .='
					#matrix-table-result, #matrix-table-result td, #matrix-table-result tr
					{ 
						border:1px solid black;
					}' . "\n";

				break;

			case $border == "side":
			default:

				$table .='#matrix-table-result {border-left:1px solid black;border-right:1px solid black;}' . "\n";
				break;

			case $border == "none":
				$table .= '' . "\n";
				break;
		}
		$table .='</style>' . "\n";

		$table .= "\n" . '<table id="matrix-table-result">' . "\n";

		for ($i = 0; $i < $this->Rows; $i++) {
			$table .= "\t<tr>\n";

			for ($j = 0; $j < $this->Cols; $j++) {
				if ($j == 0) {
					if ($inputed == TRUE) {
						$table .= "\t\t" . '<td><input type="text" required="required" style="width:40px;" id="a[' . $i . '][' . $j . ']" name="a[' . $i . '][' . $j . ']" value="' . $arr[$i][$j] . '"></td>';
					} else {
						$table .= "\t\t" . '<td>' . $arr[$i][$j] . '<td>';
					}
				} elseif ($j == $this->Cols - 1) {
					if ($inputed == TRUE) {
						$table .= '<td><input type="text" required="required" style="width:40px;" id="a[' . $i . '][' . $j . ']" name="a[' . $i . '][' . $j . ']" value="' . $arr[$i][$j] . '"></td>' . "\n";
					} else {
						$table .= '<td>' . $arr[$i][$j] . '<td>' . "\n";
					}
				} else {
					if ($inputed == TRUE) {
						$table .= '<td><input type="text" required="required" style="width:40px;" id="a[' . $i . '][' . $j . ']" name="a[' . $i . '][' . $j . ']" value="' . $arr[$i][$j] . '"></td>';
					} else {
						$table .= '<td>' . $arr[$i][$j] . '</td>';
					}
				}
			}

			$table .= "\t</tr>\n";
		}

		$table .= "</table>\n";

		return $table;
	}
	
	function import_maxy($csv_file_contents) {
		$file = $csv_file_contents; # CSV Maxy file contents
		unset($csv_file_contents);

		$count = count($file);
		$matrices = array();
		$calc = NULL;

		for ($i = 0; $i < $count; $i++) { // Number the file rows
			if ($i % 2 == 1) { // Verify if the row is a matrix or command to sum, div, etc... If it is equal 1, it is a command, else is a matrix
				$lastcmd = trim($file[$i]);
			} else { // Will be a row with a Matrix
				$rows = explode("|", $file[$i]); // Matrices Rows

				$matrices[$i] = array();

				for ($j = 0; $j < count($rows); $j++) {
					$mx = explode(",", $rows[$j]);
					$matrices[$i][$j] = $mx;
				}

				if ($i != 0) { // If is not the first row, then it will star to calculate
					if ($lastcmd == "sum") {
						if ($calc != NULL) {
							$calc = $this->sum($calc, $matrices[$i - 2]);
						} else {

							$calc = $this->sum($matrices[$i - 2], $matrices[$i]);
						}
					} elseif ($lastcmd == "sub") {
						if ($calc != NULL) {
							$calc = $this->sub($calc, $matrices[$i]);
						} else {
							$calc = $this->sub($matrices[$i - 2], $matrices[$i]);
						}
					} elseif ($lastcmd == "mult") {
						if ($calc != NULL) {
							$calc = $this->mult($calc, $matrices[$i]);
						} else {
							$calc = $this->mult($matrices[$i - 2], $matrices[$i]);
						}
					} elseif ($lastcmd == "div") {
						if ($calc != NULL) {
							$calc = $this->div($calc, $matrices[$i]);
						} else {
							$calc = $this->div($matrices[$i - 2], $matrices[$i]);
						}
					} else {
						return "Error 14: The file is not writed in the default way! Wrong command given: " . $lastcmd;
					}
				}// end of if of calculation
			}// end of Else with matrix
		}// end of For $i

		return $calc;
	}
	
	function create($rows = 1, $cols = 1, $field = 'a', $complete_table = false) {
		$matrix = '';

		if ($complete_table == true) {
			$matrix .= '<table>' . "\n";
		}

		for ($i = 0; $i < $rows; $i++) {
			$matrix .= '<tr>' . "\n";

			for ($j = 0; $j < $cols; $j++) {
				$matrix .= '<td><input type="text" name="' . $field . '[' . $i . '][' . $j . ']" style="width:40px;" id="' . $field . '[' . $i . '][' . $j . ']" required="required"></td>' . "\n";
			}

			$matrix .= '</tr>' . "\n";
		}

		if ($complete_table == true) {
			$matrix .= '</table>' . "\n";
		}

		return $matrix;
	}
}
