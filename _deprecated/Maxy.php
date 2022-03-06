<?php

namespace Maxy;

/**
 * @name MAXY
 * @author Lucas Marques Dutra (dutr4@outlook.com)
 * @since 2015-02-17  
 * @desc A PHP Framework to work with Math Bi-dimensional Matrices
 * @package SAMF - Suíte de Aplicativos Matemática e Física
 * @subpackage Maxy
 * @category Math
 * @example /path/examples/
 * @version 0.4.1
 * @copyright Copyleft by Lucas Marques Dutra - <dutr4@outlook.com>
 * @license GNU GPL v3
 */
class Maxy 
{
	/**
	 * MA.XY. Software Version
	 * @var string
	 */
	const VERSION = '0.4.1';
    
    /**
     * @var array The object itself parsed or not, as array
     */
    private $maxy;
        
	/**
	 * Number of Cols of a Matrix
	 */
	private $numberOfCols;

	/**
	 * Number of Rows of a Matrix
	 */
	private $numberOfRows;

	/**
	 * Order of a square Matrix
	 */
	private $order;

	/**
	 * Main Diagonal
	 */
	private $mainDiagonal = array();

	/**
	 * Secondary Diagonal
	 */
	private $secondaryDiagonal = array();
    
    
    /**
	 * Creates the Ma.XY. environment
	 * @param array $array
	 * @return void
	 */
	public function __construct($array) 
    {
        $this->setMaxy($array);
		$this->numberOfRows = count($array);
		$this->numberOfCols = count($array[0]);
	}
    
	/**
	 * Returns a transposed bidimensional Matrix
	 * @param array $arr
	 * @return string|array
	 */
	public function transposed()
    {
		$newMatrix = array(); 

		for ($i = 0; $i < $this->numberOfCols; $i++) { 
			$newMatrix[$i] = array(); // Creates bidimension

			for ($j = 0; $j < $this->numberOfRows; $j++) {
				$newMatrix[$i][$j] = $this->maxy[$j][$i]; //inverting Rows to Columns
			}
		}

		return $newMatrix;
	}

	/**
	 * Returns an Opposite Matrix
	 * @return string|array
	 */
	public function opposite() 
    {
        $newMatrix = array();
                
		for ($i = 0; $i < $this->numberOfRows; $i++) { // Verifying all elements by stariting with rows
			$newMatrix[$i] = array();

			for ($j = 0; $j < $this->numberOfRows; $j++) { // Verifying item by item
				$newMatrix[$i][$j] = (-1) * $this->maxy[$i][$j]; //inverting Rows to Columns
			}
		}

		return $newMatrix;
	}
    
    private function setMaxy($array) 
    {
        $this->maxy = $array;
    }
    public function get() 
    {
        return $this->maxy;
    }
    
    
}
