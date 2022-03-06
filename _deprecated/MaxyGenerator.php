<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Maxy;

/**
 * Description of MaxyGenerator
 *
 * @author Lucas
 */
class MaxyGenerator 
{
    /**
	 * @desc Creates a random matrix
	 * @param integer $lines
	 * @param integer $cols
	 * @param integer $min_valor
	 * @param integer $max_valor
	 * @param integer $decimals_digits
	 * @return array
	 */
	public function randomMaxy($lines = 3, $cols = 3, $min_valor = 1, $max_valor = 10, $decimals_digits = 1) 
    {
		$new_matrix = array();

		for ($i = 0; $i < $lines; $i++) {
			for ($j = 0; $j < $cols; $j++) {
				if ($decimals_digits == 1) {
					$new_matrix[$i][$j] = mt_rand($min_valor, $max_valor);
				} else {
					$new_matrix[$i][$j] = $this->_float_rand($min_valor, $max_valor, $decimals_digits);
				}
			}
		}

		return $new_matrix;
	}
    
    public function unitMatrix($size = 1) 
    {
		$matrix = array();

		for ($i = 0; $i < $size; $i++) {
			$matrix[$i] = array();

			for ($j = 0; $j < $size; $j++) {
				if ($j == $i) {
					$matrix[$i][$j] = 1;
				} else {
					$matrix[$i][$j] = 0;
				}
			}
		}

		return $matrix;
	}
}
