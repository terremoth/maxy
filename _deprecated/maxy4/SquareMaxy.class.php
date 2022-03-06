<?php

/*
 * and open the template in the editor.
 */
require_once './SingleMaxy.class.php';
/**
 * Description of SquareMaxys
 * @author Lucas M. Dutra
 */
class SquareMaxy extends SingleMaxy {
	
	var $order;

	function __construct($aMaxyArray, $bCheckErrors = false) {
		parent::__construct($aMaxyArray, $bCheckErrors);	
	}
	
	function order() {}
	
	function isTriangular(){}
	function isDiagonal(){}
	function isSymmetric(){}
}
