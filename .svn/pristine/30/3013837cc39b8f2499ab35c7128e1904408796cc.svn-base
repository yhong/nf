<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     prefilter.literal_script_and_style.php
 * Type:     prefilter
 * Name:     literal_script_and_style
 * Purpose:  display javascript
 * -------------------------------------------------------------
 */

function smarty_prefilter_literal_script_and_style(&$tpl_source, &$smarty) { 
	$pattern[] = '~<script\b(?![^>]*smarty)(.*)</script>~siU'; 
	$replace[] = '<!-- {literal} --><script$1 $2</script><!-- {/literal} -->'; 
	$pattern[] = '~<style\b(?![^>]*smarty)>(.*)</style>~siU'; 
	$replace[] = '<!--{literal}--><style$1>$2</style><!--{/literal}-->'; 
	
	return preg_replace($pattern, $replace, $tpl_source); 
} 
?>