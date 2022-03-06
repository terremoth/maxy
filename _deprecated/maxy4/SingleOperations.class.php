<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Lucas M. Dutra
 */
class SingleOperations {

	function builder($sExpr) {
		
	}

	function getIdentity($iSize) {
		
	}

	function opN($aMaxy, $iNum, $sOperator = '+') {
		
	}

	function unitMatrix($size = 1) {

		$maxy = array();

		for ($i = 0; $i < $size; $i++) {
			$maxy[$i] = array();

			for ($j = 0; $j < $size; $j++) {
				if ($j == $i) {
					$maxy[$i][$j] = 1;
				} else {
					$maxy[$i][$j] = 0;
				}
			}
		}

		return $maxy;
	}

	/**
	 * Organizes the matrices positions
	 * @param array $arr
	 * @return array
	 */
	protected function organize($arr) {
		$new_matrix = array();
		$size = count($arr);

		for ($i = 0; $i < $size; $i++) {
			$new_matrix[$i] = array_values($arr[$i]);
		}

		return $new_matrix;
	}

}
