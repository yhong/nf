<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     smarty_function_FILE_TYPE_TO_ICON.php
 * Type:     function
 * Name:     FILE_TYPE_TO_ICON
 * Purpose:  return image which is about the extension
 * -------------------------------------------------------------
 */
function smarty_function_FILE_TYPE_TO_ICON($params, &$smarty)
{
	switch(strtolower(trim($params["ext"]))){ 
		case 'doc':
			$sFileType = "doc.gif";
			break;
		case 'exe':	
			$sFileType = "exe.gif";
			break;
		case 'txt':
			$sFileType = "txt.gif";
			break;
		case 'hwp':
			$sFileType = "hwp.gif";
			break;		
		case 'pdf':
			$sFileType = "pdf.gif";
			break;
		case 'jpg':
		case 'png':
		case 'gif':
			$sFileType = "gif.gif";
			break;
		case 'img':
			$sFileType = "img.gif";
			break;
		case 'mp3':
		case 'wma':			
		case 'wav':
		case 'avi':
		case 'mov':
		case 'wmv':
			$sFileType = "wav.gif";
			break;	
		case 'ppt':
			$sFileType = "ppt.gif";
			break;
						
		case 'zip':
			$sFileType = "zip.gif";
			break;
		case 'xls':
			$sFileType = "xls.gif";
			break;

					
				}
	return $sFileType;
}
?> 
