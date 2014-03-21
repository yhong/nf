<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     smarty_function_SHORT_STR.php
 * Type:     function
 * Name:     LEFT_TIME
 * Purpose:  return left time(subtraction between input time and current time)
 * -------------------------------------------------------------
 */
function smarty_function_SHORT_STR($params, &$smarty)
{
	if(strlen($params["str"]) > intval($params["length"])){
		return mb_strcut($params["str"], 0, intval($params["length"]), 'UTF-8')."...";
	}else{
		return $params["str"];
	}
}
?> 
