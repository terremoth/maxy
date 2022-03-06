<?php

namespace Maxy;

class MaxyOperations 
{
    
	public function sum($arr1, $arr2) 
    {
		$check = $this->hasEqualSize($arr1, $arr2);
		if ($check !== TRUE) {
			return $check;
		}

		$new_matrix = array();

		for ($i = 0; $i < $this->Rows; $i++) {
			$new_matrix[$i] = array();

			for ($j = 0; $j < $this->Cols; $j++) {
				$new_matrix[$i][$j] = $arr1[$i][$j] + $arr2[$i][$j];
			}
		}

		return $new_matrix;
	}

	public function sub($arr1, $arr2) 
    {
		$check = $this->hasEqualSize($arr1, $arr2);

		if ($check !== TRUE) {
			return $check;
		}

		$new_matrix = array();
		for ($i = 0; $i < $this->Rows; $i++) {
			$new_matrix[$i] = array();

			for ($j = 0; $j < $this->Cols; $j++) {
				$new_matrix[$i][$j] = $arr1[$i][$j] - $arr2[$i][$j];
			}
		}

		return $new_matrix;
	}


	public function mult($arr1, $arr2) 
    {
		$check = $this->hasInverseSize($arr1, $arr2);

		if ($check !== TRUE) {
			return $check;
		}

		$new_matrix = array();

		for ($i = 0; $i < $this->Group[0][0]; $i++) { // Counting and passing through the rows..
			$new_matrix[$i] = array();

			for ($j = 0; $j < $this->Group[1][1]; $j++) {
				$acumula = 0;
				$new_matrix[$i][$j] = array();

				for ($k = 0; $k < $this->Group[0][1]; $k++) {
					$acumula = $acumula + $arr1[$i][$k] * $arr2[$k][$j];
				}

				$new_matrix[$i][$j] = $acumula;
			}
		}

		return $new_matrix;
	}

	function div($arr1, $arr2) {
		//$check = $this->check_opost_size($arr1, $arr2);

		if ($this->hasInverseSize($arr1, $arr2) != TRUE) {
			return $check;
		}

		$new_matrix = array();

		$arr2 = $this->getInverse($arr2);

		for ($i = 0; $i < $this->Group[0][0]; $i++) { // Counting and passing through the rows..
			$new_matrix[$i] = array();

			for ($j = 0; $j < $this->Group[1][1]; $j++) {
				$accumulate = 0;
				$new_matrix[$i][$j] = array();

				for ($k = 0; $k < $this->Group[0][1]; $k++) {
					$accumulate = $accumulate + $arr1[$i][$k] * $arr2[$k][$j];
				}

				$new_matrix[$i][$j] = $accumulate;
			}
		}

		return $new_matrix;
	}
    
	
	/**
	 * 
	 * @param array $arr1
	 * @param array $arr2
	 * @return boolean
	 */
	function is_inverse($arr1, $arr2) {
		$new_matrix = $this->mult($arr1, $arr2);
		$unit = $this->unitMatrix(count($new_matrix));

		if ($this->is_equal($new_matrix, $unit)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
    
    
    function hasEqualSize($arr1, $arr2) {
		

		$m1r = $this->Rows;
		$m1c = $this->Cols;

		$check = $this->checkArrayErrors($arr2);

		if ($check != "Success") {
			return $check;
		}

		$m2r = $this->Rows;
		$m2c = $this->Cols;

		if ($m1r == $m2r && $m1c == $m2c) {
			return TRUE;
		} else {
			return "Error 09: The Matrices does not have the same size: a" . $m1r . $m1c . " and b" . $m2r . $m2c;
		}
	}

	function hasInverseSize($arr1, $arr2) {

		$m1r = $this->Rows;
		$m1c = $this->Cols;

		$this->Group[0] = array(0 => $m1r, 1 => $m1c);

		$m2r = $this->Rows;
		$m2c = $this->Cols;

		$this->Group[1] = array(0 => $m2r, 1 => $m2c);

		return ($m1r == $m2c && $m1c == $m2r);
	}
    
}
