<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.SHOW_ATTACH.php
 * Type:     function
 * Name:     SHOW_ATTACH
 * Purpose:  display the file which is attached in server
 * -------------------------------------------------------------
 */
function smarty_function_SHOW_ATTACH($params, &$smarty)
{

	$ext = explode(".", $params["filename_after"]);

	switch(strtolower($ext[1])){
					case 'gif':
					case 'img':
					case 'jpg':
					case 'png':
						return '<img src="/'.$params["root"].'/'.$params["filepath"].'/'.$params["filename"].'">';
						break;
					case 'wav':
					case 'mp3':
					case 'wma':
					case 'avi':
					case 'mov':
					case 'wmv':
						return '<EMBED src="/'.$params["root"].'/'.$params["filepath"].'/'.$params["filename"].'" type=application/x-mplayer2 autostart="false"></EMBED>';
						break;
					case 'ppt':
					case 'zip':
					case 'xls':
					case 'doc':
					case 'txt':
					case 'hwp':
					case 'pdf':
						return $params["filename_before"];
						break;
					default:
						return $params["filename_before"];
	}
}
?> 
