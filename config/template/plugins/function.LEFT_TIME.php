<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     smarty_function_LEFT_TIME.php
 * Type:     function
 * Name:     LEFT_TIME
 * Purpose:  return left time(subtraction between input time and current time)
 * -------------------------------------------------------------
 */
function smarty_function_LEFT_TIME($params, &$smarty)
{
	$after_sec = intval(time()-intval($params["time"]));

	if ($after_sec < 60) {
		return $after_sec.I("SEC_AGO");
	} else if($after_sec < 120) {
		return I("ABOUT_AMIN_AGO");
	} else if($after_sec < (60*60)) {
		return (intval($after_sec / 60)).I("MIN_AGO");
	} else if($after_sec < (120*60)) {
		return I("ABOUT_AHOUR_AGO");
	} else if($after_sec < (24*60*60)) {
		return I("ABOUT").' ' + (intval($after_sec / 3600)).I("HOUR_AGO");
	} else if($after_sec < (48*60*60)) {
		return '1 '.I("DAY_AGO");
	} else if($after_sec < (48*60*60*30)) {
		return (intval($after_sec / 86400)).' '.I("DAYS_AGO");
	} else {
		return date("Y-m-d h:i", $params["time"]);
	}
}
?> 
