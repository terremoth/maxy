<?php

# acb.class.php

/**
 * @name ACB - Análise ComBinatória 
 * @package SAMF - Suíte de Aplicativos Matemática e Física
 * @subpackage Math
 * @category Math
 * @example /path/examples/
 * @since 2015-12-17
 * @author Lucas Marques Dutra (dutr4@outlook.com)
 * @access Private
 * @copyright Copyright &copy; Lucas Marques Dutra - dutr4@outlook.com
 * @version 1.0
 * @license
 * @desc A huge class to work with Combinatorics
 *
 */
//abstract
class Acb
{

	/**
	 * @desc MA.XY. Software Version
	 * @var string
	 */
	const VERSION = "1.0";
	
	
	public function __construct()
	{
		/*$num_args = func_num_args();
		$args = func_get_args();
		func_get_arg($arg_num);
		
		foreach (func_get_args() as $key => $value) 
		{
			;
		}
		*/
	}
	
	function factorial($n) 
	{
        if ($n == 1) {
            return 1;
        }
        
        return $n * $this->factorial($n-1);
    }
	
	public function anagram($n, $repeat=array())
	{
		$repetitions = 1;
		
		if (!empty($repeat)) 
		{
			foreach ($repeat as $value) 
			{
				$repetitions *= $this->factorial($value);
			}
		}
		
		return ($this->factorial($n)/$repetitions);
	}
	
	function arranjo_simples($n=0, $p=0) 
	{
		return $this->factorial($n)/$this->factorial($n-$p);
	}
	
	
	protected function getError($number, $info1=null, $info2=null)
	{
		ini_set("display_errors", 1);
	
		$errors =
		[
				/*0 */	
	
		];
	
		$message = 'Error '.$number.': '.$errors[$number];
	
		die($message);
	}
	
	
}