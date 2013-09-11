<?php
/*
* Templete Class
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package Object
*/
abstract class Nayuda_Template_Abstract extends Nayuda_Object{

	// Set variable
	abstract public function assign($id, $value = null);
	
	// Set layout
	abstract public function setLayout($sLayoutName, $sSubLayoutName = null);

    // Get block
    abstract public function blockFetch($file);

	// Display for layout
	abstract public function errorDisplay($tpl_name);

	// display for layout
	abstract public function display($tpl_name);
}
?>
