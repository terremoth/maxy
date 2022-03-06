<?php

namespace Maxy;

/**
 * Description of maxy_calc
 *
 * @author Lucas Marques Dutra
 */
class SquareMaxy extends \Maxy
{
	
    public function __construct($array) 
    {
        parent::__construct($array);
    }

    /**
	 * Returns the Main Diagonal of a Square Matrix
	 * # Tested
	 * @param array $arr
	 * @return string|array
	 */
	public function mainDiagonal($arr) 
    {
		$order = $this->getOrder();

		if (!is_numeric($order)) {
			return $order;
		}

		$md = array();

		for ($i = 0; $i < $order; $i++) {
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
	public function secondaryDiagonal($arr) 
    {
		$order = $this->getOrder();

		if (!is_numeric($order)) {
			return $order;
		}

		$secd = array();

		for ($i = 0; $i < $order; $i++) {
			$secd[$i] = $arr[$i][$order - 1 - $i];
		}

		return $secd;
	}
	
	
	function det1($arr) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		} elseif ($this->Order != 1) {
			return "Error 11: The Matrix must be in 1st order.";
		} else {
			//Unique
			$det = $arr[0][0];

			return $det;
		}
	}

	function det2($arr) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		} elseif ($this->Order != 2) {
			return "Error 12: The Matrix must be in 2nd order.";
		} else {
			//Main - Secondary
			$det = ($arr[0][0] * $arr[1][1]) - ($arr[0][1] * $arr[1][0]);

			return $det;
		}
	}

	function det3($arr) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		} elseif ($this->Order != 3) {
			return "Error 13: The Matrix must be in 3rd order.";
		} else {
			//Main
			$dp = $arr[0][0] * $arr[1][1] * $arr[2][2];
			$dp += $arr[0][1] * $arr[1][2] * $arr[2][0];
			$dp += $arr[0][2] * $arr[1][0] * $arr[2][1];

			//Secondary
			$sec = $arr[0][2] * $arr[1][1] * $arr[2][0]; //ok
			$sec += $arr[0][0] * $arr[1][2] * $arr[2][1]; //ok
			$sec += $arr[0][1] * $arr[1][0] * $arr[2][2]; //ok

			$det = $dp - $sec; // Main - Secondary
			return $det;
		}
	}

	function quick_less_complem($arr) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		}

		array_shift($arr); // Erases first row

		for ($i = 0; $i < count($arr); $i++) {
			array_shift($arr[$i]); // erases first elements of each row
		}

		return $arr;
	}

	function less_complem($arr, $iA, $jA) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		}

		$horizontal_size = count($arr);

		for ($i = 0; $i < $horizontal_size; $i++) {
			if ($i == $iA) {
				unset($arr[$i]);
			} else {
				$vertical_size = count($arr[$i]);

				for ($j = 0; $j < $vertical_size; $j++) {
					if ($j == $jA) {
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

	function det($arr) {
		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		}

		$size = $this->Order;


		switch ($size) {
			case 1:
				return $this->det1($arr);
			case 2:
				return $this->det2($arr);
			case 3:
				return $this->det3($arr);
			default:
				return $this->laplace($arr);
		}
	}

	function laplace($arr, $fila = "i=0") {
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
		for ($j = 0; $j < $size; $j++) {
			$det += $arr[0][$j] * $this->cofactor($arr, 0, $j);
		}

		return $det;
	}

	function cofactor($arr, $i, $j) {
		# Aij = (-1)^i+j * less_complem($arr, $i, $j);

		$check = $this->check_square_matrix($arr);

		if ($check != "Success") {
			return $check;
		}

		$value = pow(-1, $i + $j) * $this->less_complem($arr, $i, $j);

		return $value;
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

	/**
	 * Gets the inverse of a matrix
	 * @param array $arr
	 * @return string|array
	 */
	public function inverse($arr) 
    {
		// Verify if matrix determinant is equal zero, if it is, there are no inverse

		$det = $this->det($arr);

		if ($det == 0) {
			return "This Matrix has no inverse!";
		} else {
			$adj = $this->adjoint($arr); // adjoint matrix

			$new_matrix = array();

			for ($i = 0; $i < count($adj); $i++) {
				for ($j = 0; $j < count($adj); $j++) {
					$new_matrix[$i][$j] = $adj[$i][$j] / $det;
				}
			}

			return $new_matrix;
		}
	}

	public function adjoint($arr) 
    {
		$cofactorMatrix = $this->createCofactorMatrix($arr);
		return $this->transposed($cofactorMatrix);
	}

	/**
	 * Creates a cofactor matrix
	 * @param array $arr
	 * @return array
	 */
	function createCofactorMatrix($arr) {
		$new_matrix = array();

		for ($i = 0; $i < count($arr); $i++) {
			for ($j = 0; $j < count($arr[$i]); $j++) {
				$new_matrix[$i][$j] = $this->cofactor($arr, $i, $j);
			}
		}

		return $new_matrix;
	}
	
	/**
	 * Organizes the matrices positions
	 * @param array $arr
	 * @return array
	 */
	private function _organize($arr) {
		$new_matrix = array();
		$size = count($arr);

		for ($i = 0; $i < $size; $i++) {
			$new_matrix[$i] = array_values($arr[$i]);
		}

		return $new_matrix;
	}

	private function _fill_with_zeros($arr, $order = 1) {
		for ($i = 0; $i < $order; $i++) {
			for ($j = 0; $j < $order; $j++) {
				// if is clearly empty, fill with zeros:
				if (!isset($arr[$i][$j]) or in_array($arr[$i][$j], array(NULL, '', ' ', false))) {
					$arr[$i][$j] = 0;
				}
			}
		}

		return $arr;
	}


	/**
	 * Generate Float Random Number
	 * @param float $Min Minimal value
	 * @param float $Max Maximal value
	 * @param int $round The optional number of decimal digits to round to. default 0 means not round
	 * @return float
	 */
	protected function _float_rand($Min, $Max, $round = 0) {
		//validate input
		if ($Min > $Max) {
			$min = $Max;
			$max = $Min;
		} else {
			$min = $Min;
			$max = $Max;
		}

		$randomfloat = $min + mt_rand() / mt_getrandmax() * ($max - $min);

		if ($round > 0) {
			$randomfloat = round($randomfloat, $round);
		}

		return $randomfloat;
	}
	
   
}
