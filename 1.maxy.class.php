<?php

# maxy.class.php

require_once './maxy_helper.trait.php';
require_once './maxy_operations.trait.php';
require_once './maxy_file.trait.php';

/**
 * @name MA.XY. (Matrixy)
 * @package SAMF - Suíte de Aplicativos Matemática e Física
 * @subpackage Math
 * @category Math
 * @example /path/examples/
 * @since 2015-02-17  
 * @author Lucas Marques Dutra (dutr4@outlook.com)
 * @access Private
 * @copyright Copyright &copy; Lucas Marques Dutra - <dutr4@outlook.com>
 * @version 4.1
 * @license
 * @desc A PHP Framework to work with Math Bi-dimensional Matrices
 */
class Maxy {

	/**
	 * @desc MA.XY. Software Version
	 * @var string
	 */
	const VERSION = "4.1";

	/**
	 * @desc Error_Strict
	 * @var array
	 */
	private $ErrorStrict = FALSE;

	/**
	 * Group of arrays that pretend to be matrices
	 * @var array
	 */
	private $arrGroup = array();

	/**
	 * Number of Cols of a Matrix
	 * @var integer
	 */
	protected $Cols = array();

	/**
	 * Number of Rows of a Matrix
	 * @var integer
	 */
	protected $Rows = array();

	/**
	 * Order of a square Matrix
	 * @var integer
	 */
	protected $Order = array();

	/**
	 * @desc Matrices
	 * @var array
	 */
	protected $Matrices = array();

	/**
	 * @desc Group
	 * @var array
	 */
	protected $Group = array();

	/**
	 * @desc List of Squares Matrices
	 * @var array
	 */
	protected $SquareMatricesList = array();

	/**
	 * @desc Creates the Ma.XY. environment
	 * @param array $arr1
	 * @param array $arr2
	 * @return void
	 */
	function __construct($arr1, $arr2 = false) {

		if (!$this->ErrorStrict) {
			$this->loadMaxy($arr1);

			if ($arr2 != false) {
				$this->loadMaxy($arr2);
			}
		} else {
			$this->loadVerifiedMaxy($arr1);

			if ($arr2 != false) {
				$this->loadVerifiedMaxy($arr2);
			}
		}
	}

	function loadMaxy($arr) {
		$row1 = count($arr);
		$column1 = count($arr[0]);
		$this->setRowsTo($row1);
		$this->setColsTo($column1);
		$this->setMatricesTo($arr);
	}

	function loadVerifiedMaxy($arr) {

		if ($this->checkArrayErrors($arr)) {
			$this->loadMaxy($arr);
			return true;
		} else {
			return false;
		}
	}

	// GETTERS:
	/*	 * ************************************************************************************************************ */

	/**
	 * Returns Software Version
	 * @return string
	 */
	function getVersion() {
		return self::VERSION;
	}

	static function isErrorStrict() {
		return $this->ErrorStrict;
	}

	function getCols($maxy_index) {
		return $this->Cols[$maxy_index];
	}

	function getRows($maxy_index) {
		return $this->Rows[$maxy_index];
	}

	function getOrder($maxy_index) {
		return $this->Order[$maxy_index];
	}

	function getMatrices($maxy_index) {
		return $this->Matrices[$maxy_index];
	}

	function getGroup($maxy_index) {
		return $this->Group[$maxy_index];
	}

	function setCols($cols) {
		$this->Cols[] = $cols;
	}

	function setRows($rows) {
		$this->Rows[] = $rows;
	}

	function setOrder($order) {
		$this->Order[] = $order;
	}

	function setMatrices($matrices) {
		$this->Matrices[] = $matrices;
	}

	function setGroup($group) {
		$this->Group[] = $group;
	}

	static function setErrorStrict($ErrorStrict) {
		if (is_bool($ErrorStrict)) {
			$this->ErrorStrict = $ErrorStrict;
		} else {
			$this->getError(16);
		}
	}

//	/***** Setting specifying the index: *************************************************************************************** */
	function setColsTo($cols) {
		$this->Cols[] = $cols;
	}

	function setRowsTo($rows) {
		$this->Rows[] = $rows;
	}

	function setOrderTo($order) {
		$this->Order[] = $order;
	}

	function setMatricesTo($matrices) {
		$this->Matrices[] = $matrices;
	}

	function setGroupTo($group) {
		$this->Group[] = $group;
	}

}
