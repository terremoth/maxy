<?php

/**
 * Helps to Check and Find Errors in Maxy Class
 *
 * @author Lucas Marques Dutra
 */
class MaxyHelper
{
    
    /**
	 * Creates the Ma.XY. environment
	 * @param array $array
	 * @return void
	 */
	public function __construct($array, $checkErrors = true) 
    {
		if ($checkErrors) {
			$this->checkMaxyErrors($array);
		}
		
        $this->loadMaxy($array);
	}

	public function checkMaxyErrors($rawArray) 
    {
   		if ( ! is_array($rawArray) ) {
			die('Error: It is not a matrix structure, must be an array.');
		}

		$rows = count($rawArray);
		$rowItemsQuantity = array();

		for ($i = 0; $i < $rows; $i++) {
			// Conta a quantidade de itens nas linhas p/ verificar se colunas == linhas;
			
            is_array($rawArray[$i]) ?: die('Error: Matrix row ' . $i . ' is not an Array');
            
			$quant = count($rawArray[$i]);
			$rowItemsQuantity[$i] = $quant;

			for ($j = 0; $j < $quant; $j++) {
				$item = $rawArray[$i][$j];

				!is_array($item)                    ?: die('Error: Element at row ' . $i . ' and column ' . $j . ' is multidimensional, only bidimensional matrices are permitted');
				( ! (empty($item) and $item != 0))  ?: die('Error: Element at row ' . $i . ' and column ' . $j . ' cannot be empty!');
				is_numeric($item)                   ?: die('Error: Element at row ' . $i . ' and column ' . $j . ' is not numeric!');
			}
		}
        
        $this->isRectangular($rowItemsQuantity);

		return true;
	}
    
    /**
     * 
     * Verify if $arr is a square Matrix or not, by checking the same quantity of columns
     * @param array $rowItemsQuantity
     * @return boolean|void
     */
    public function isRectangular($rowItemsQuantity) 
    {
        $isRectangular = count(array_unique($rowItemsQuantity)) == 1;
        return ($isRectangular) ? true : die('Error: The given array is not a matrix, because is not rectangular');
    }

        /**
	 * Returns Matrix Order
	 * # Tested
	 * @param array $arr
	 * @return string|number
	 */
	public function getOrder($maxy_index) 
    {
		
	}

	/**
	 * Checks if a Matrix is Square
	 * @param array $arr
	 * @return string
	 */
	function isSquareMaxy($maxy_index) {
		# Verify if number of rows == number of cols

		if ($this->getCols($maxy_index) == $this->getRows($maxy_index)) {
			$this->setOrder($this->getRows($maxy_index)); //or = $this->Cols, does not matter
			return true;
		} elseif ($this->getCols($maxy_index) > $this->getRows($maxy_index)) {
			$this->getError(5);
		} elseif ($this->getCols($maxy_index) < $this->getRows($maxy_index)) {
			$this->getError(6);
		}
	}

	

	/**
	 * Verify if two matrices has the same order and the same elements
	 * @param unknown $arr1
	 * @param unknown $arr2
	 * @return string|boolean
	 */
	function check_equal($arr1, $arr2) {
		$check = $this->isSquareMaxy($arr1);

		if ($check != "Success") {
			return $check;
		}

		$order1 = $this->Order;

		$check = $this->isSquareMaxy($arr2);

		if ($check != "Success") {
			return $check;
		}

		$order2 = $this->Order;

		if ($order1 != $order2) {
			return 'Error 15: The Matrices are not equal! First is order ' . $order1 . ' and second is order ' . $order2;
		}

		for ($i = 0; $i < $this->Order; $i++) {
			for ($j = 0; $j < count($arr2); $j++) {
				if ($arr1[$i][$j] != $arr2[$i][$j]) {
					return FALSE;
				}
			}
		}

		return TRUE;
	}

	protected function getError($number, $info1 = null, $info2 = null) 
    {
		ini_set("display_errors", 1);

		$errors = [
			/* 0 */ 'Element at row ' . $info1 . ' and column ' . $info2 . ' is multidimensional, only bidimensional matrices are permitted',
			/* 1 */ 'Element at row ' . $info1 . ' and column ' . $info2 . ' cannot be empty!',
			/* 2 */ 'Element at row ' . $info1 . ' and column ' . $info2 . ' is not numeric!',
			/* 3 */ 'Matrix row number ' . $info1 . ' is not an Array',
			/* 4 */ 'Is not a Matrix! (Not retangular)',
			/* 5 */ 'Matrix is not square: There are more columns than rows!',
			/* 6 */ 'Matrix is not square: There are more rows than columns',
			/* 7 */ 'It is not a matrix form',
			/* 8 */ 'The Matrices does not have the same size: a' . $info1 . ' and b' . $info2,
			/* 9 */ 'The Matrices does not have the opost size: a' . $info1 . ' and b' . $info2,
			/* 10 */ 'The Matrix must be in 1st order.',
			/* 11 */ 'The Matrix must be in 2nd order.',
			/* 12 */ 'The Matrix must be in 3rd order.',
			/* 13 */ 'The file is not writed in the default way! Wrong command given: ' . $info1,
			/* 14 */ 'The Matrices are not equal! First is order ' . $info1 . ' and second is order ' . $info2,
			/* 15 */ 'The file specified does not exist!',
			/* 16 */ 'Error-Strict param Method must be boolean',
		];

		$message = 'Error ' . $number . ': ' . $errors[$number];

		die($message);
	}

}
