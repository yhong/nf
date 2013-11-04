<?php

/*
* Top Class of All Class
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package Object
*/

class Nayuda_Object {
	function __construct() {
		$args = func_get_args();
		if (method_exists($this, '__destruct')) {
			register_shutdown_function (array(&$this, '__destruct'));
		}
		call_user_func_array(array(&$this, '__construct'), $args);
	}

	function toString() {
		$class = get_class($this);
		return $class;
	}
}
?>
