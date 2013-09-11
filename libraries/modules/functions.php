<?php
/**
 * Nayuda
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@nayuda.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Globalnto to newer
 * versions in the future. If you wish to customize Globalnto for your
 * needs please refer to http://framework.nayuda.com for more information.
 *
 * @category   Main
 * @package    Main
 * @copyright  Copyright (c) 2012 Nayuda Inc.
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Loading Libraries
 *
 * using:
 * loadLibrary('Archive/Zip', 'Board/FormList');
 *
 * @param set the library name without '.php'
 */
//function __autoload($filename){
function _NAYUDA_AUTOLOADER($filename){
	$target_chr = array(".", "-", "@", "#", "_");
	$classname = str_replace($target_chr, DS, $filename);
	$arrClass = explode(DS, $classname);

	$subPath = "";
	for($i=0; $i<(count($arrClass) - 1); $i++){
		$subPath .= $arrClass[$i].DS;	
	}

	if(file_exists($subPath.'/Abstract.php')){
		require_once($subPath.'/Abstract.php');
	}
	require_once($classname.'.php');
}
spl_autoload_register("_NAYUDA_AUTOLOADER");

/**
 * File search if include file is existing
 *
 * @param string $file file for searching
 * @return bool is there file existing?
 */
 
function FILE_EXISTS_IN_PATH($file) {
	$paths = explode(PATH_SEPARATOR, ini_get("include_path"));
	foreach ($paths as $path) {
		$fullPath = $path . DIRECTORY_SEPARATOR . $file;

		if (file_exists($fullPath)) {
			return $fullPath;
		} elseif (file_exists($file)) {
			return $file;
		}
	}
	return false;
}

function getModel($model, $alias=null, $config=null){

	$modelPath = str_replace("_", DS, $model);
	$include_file = MODEL_PATH.DS.$modelPath.".php";

    if(!FILE_EXISTS_IN_PATH($include_file)){
       $include_file = APP_ROOT.DS."base".DS.MAIN_APP_NAME.DS.MODEL_DIR.DS.$modelPath.".php";
    }

    if(FILE_EXISTS_IN_PATH($include_file)){
		require_once($include_file);
		
		$modelName = "Model_".$model;
		$objModel = new $modelName($config);

		if($alias){
			$objModel->setAlias($alias);
		}
		return $objModel;

	}else{
        die($include_file." does not exist!");
    }

	return null;
}

function STYLE_SHEET($path){
	return '<link rel="stylesheet" type="text/css" href="'.$path.'.css">'; 
}

function GET($index = null, $value = null){
	if(!$index){
		return $_GET;
	}else{
		if(array_key_exists($index, $_GET) && $value == null){
			if($_GET[$index]){
				return $_GET[$index];
			}
            return null;
		}else{
			$_GET[$index] = $value;
			return $value;
        }
	}
}

function POST($index = null, $value = null){
	if(!$index){
		return $_POST;
	}else{
		if(array_key_exists($index, $_POST) && $value == null){
			if($_POST[$index]){
				return $_POST[$index];
			}
            return null;
		}else{
			$_POST[$index] = $value;
			return $value;
        }
	}
}

function SESSION($index = null, $value = null){
	if(!$index){
		return $_SESSION;
	}else{
		if(array_key_exists($index, $_SESSION) && $value == null){
			if($_SESSION[$index]){
				return $_SESSION[$index];
			}
            return null;
		}else{
			$_SESSION[$index] = $value;
			return $value;
        }
	}
}

function COOKIE($index = null, $value = null){
	if(!$index){
		return $_COOKIE;
	}else{
		if(array_key_exists($index, $_COOKIE) && $value == null){
			if($_COOKIE[$index]){
				return $_COOKIE[$index];
			}
            return null;
		}else{
			$_COOKIE[$index] = $value;
			return $value;
        }
	}
}

function SERVER($index = null){
	if(!$index){
		return $_SERVER;
	}
	if(array_key_exists($index, $_SERVER)){
		if($_SERVER[$index]){
			return $_SERVER[$index];
		}
	}else{
		return null;
	}
}

function GO($page, $sec=0){
	echo "<meta http-equiv='refresh' content='".$sec."; url=".$page."'>";
	exit;
}

function ALERT($msg, $back=false){
	echo "<script>";
    echo "alert('".$msg."');";
    if($back){
        echo "history.back(-1);";
    }
    echo "</script>";
}

/**
 * loading for environment information
 *
 * @param  string $key  key name
 * @return string environment text
 */
function ENV($key) {
$server = SERVER();
	if ($key == "HTTPS") {
		if (SERVER()) {
			return (SERVER("HTTPS") == "on");
		}
		return (strpos(getenv("SCRIPT_URI"), "https://") === 0);
	}

	if ($key == "SCRIPT_NAME") {
		$cgi_mode = getenv("CGI_MODE");
		$script_url = getenv("SCRIPT_URL");
		if ($cgi_mode && isset($script_url)) {
			$key = "SCRIPT_URL";
		}
	}

	$val = null;
	if (SERVER($key)) {
		$val = SERVER($key);
	} elseif (getenv($key)) {
		$val = getenv($key);
	} elseif (getenv($key) !== false) {
		$val = getenv($key);
	}

	if ($key == "REMOTE_ADDR" && $val == getenv("SERVER_ADDR")) {
		$addr = getenv("HTTP_PC_REMOTE_ADDR");
		if ($addr != null) {
			$val = $addr;
		}
	}

	if ($val !== null) {
		return $val;
	}

	switch ($key) {
		case "SCRIPT_FILENAME":
			if (defined("SERVER_IIS") && SERVER_IIS === true){
				return str_replace("\\\\", "\\", env('PATH_TRANSLATED') );
			}
			break;
		case "DOCUMENT_ROOT":
			$offset = 0;
			if (!strpos(getenv("SCRIPT_NAME"), ".php")) {
				$offset = 4;
			}
			return substr(getenv("SCRIPT_FILENAME"), 0, strlen(getenv("SCRIPT_FILENAME")) - (strlen(getenv("SCRIPT_NAME")) + $offset));
			break;
		case "PHP_SELF":
			return r(getenv("DOCUMENT_ROOT"), '', getenv("SCRIPT_FILENAME"));
			break;
		case "CGI_MODE":
			return (PHP_SAPI == "cgi");
			break;
		case "HTTP_BASE":
			$host = getenv("HTTP_HOST");
			if (substr_count($host, '.') != 1) {
				return preg_replace ("/^([^.])*/i", null, getenv("HTTP_HOST"));
			}
			return '.' . $host;
			break;
	}
	return null;
}


/**
 * get microtime
 *
 * @return float 마이크로 시간
 */
 
function GET_MICROTIME() {
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}

function GET_INSTANCE($sPointOfClass, $arrParams) {
	$target_chr = array(".", "-", "@", "#");
	$replace   = "_";
	$classname = str_replace($target_chr, $replace, $sPointOfClass);
	
	return new $classname($arrParams);
}

/**
 * Loading PEAR Libraries
 *
 * using:
 * LOAD_PEAR_CLASS('HTTP','Request');
 *
 * @param Set package and class name 
 */
function LOAD_PEAR_CLASS($package){
	require_once($package.'.php');
}

/**
 * execute method which is in other controller
 *
 * using:
 * LOAD_CONTROLLER_MODULE("auth", "mainLoginForm")
 *
 * @param controller, method
 */
function LOAD_CONTROLLER_MODULE($controller, $method, $param = null){
	require_once(CONTROLLER_PATH.DS.$controller."_controller.php");
	$class_name = $controller."_controller";
	
	$arrParam["controller"] = $controller;
	$arrParam["action"] = $method;
	$arrParam["param"] = $param;
	
	$oInstance = new $class_name($arrParam);
	return $oInstance->{$method}($param);
}

function GET_APP_INFO($appName){
    if($appName == "www"){
        $appName = MAIN_APP_NAME;
    }
	$xml = simplexml_load_file(APP_ROOT.DS."apps.xml");
	$node = $xml->{$appName};

	if($node && $node->enable == "true"){
		foreach($node->depends as $element){
			foreach(array_keys(get_object_vars($element)) as $dependsApp){
				if($xml->{$dependsApp}->enable == "false" || !$xml->{$dependsApp}){
					die("app has dependency issue (".$dependsApp." of ".$appName.")");
				}
			}
		}
		return array("enable"=>$node->enable, "location"=>$node->location);
	}else{
		die($appName." does not be enabled!");
	}
}

/**
 * read environment value by parameter
 *
 * using:
 * GET_CONFIG("session", "name")
 *
 * @param Key,field
 */
function GET_CONFIG($sCategory, $sAttributeName){
	$config_file = CONFIG_PATH.DS."config.xml";
	if(is_file(APP_CONFIG_PATH.DS."config.xml")){
		$config_file = APP_CONFIG_PATH.DS."config.xml";
	}
	$xml = simplexml_load_file($config_file);
	$node = $xml->{$sCategory};
    if($node){
        foreach($node->element as $element){
            if($element["name"] == $sAttributeName){
                    return $element["value"];
            }
        }
    }

	$config_file = CONFIG_PATH.DS."config.xml";
    if(!is_file($config_file)){
        die("config file(config.xml) does not exist!");
    }
	$xml = simplexml_load_file($config_file);
	$node = $xml->{$sCategory};
    if($node){
        foreach($node->element as $element){
            if($element["name"] == $sAttributeName){
                    return $element["value"];
            }
        }
    }else{
        die($sCategory.".".$sAttributeName." does not exist in config.xml");
    }

    return "";
}

// Support multylanguage(LANG_PATH)
function I($sId){
	// [HTTP_ACCEPT_LANGUAGE] => ko-kr,ko;q=0.7,en-us;q=0.3
	$lang_list = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    // local
	$selected_lang = "";
	foreach($lang_list as $value){
		$lang = explode(";", $value);
		$sub_lang = explode("-", $lang[0]);
		$browser_lang = $sub_lang[0];
		if(file_exists(CONFIG_LANG_PATH.DS.$browser_lang.".xml")){
			$selected_lang = $browser_lang;
			break;
		}
	}

	// checking the exist of language directory
	if($selected_lang == ""){
		// load default language
		$selected_lang =  GET_CONFIG("language", "type");
	}

    // check local language file
    $lang_file = CONFIG_LANG_PATH.DS.$selected_lang.".xml";
    if(is_file($lang_file)){
        $xml = simplexml_load_file($lang_file);
        foreach($xml->word as $element){
            if($element["id"] == $sId){
                    return (string)$element["value"];
            }
        }
    }

    // glabal
    $appInfo = GET_APP_INFO("_main");
	$selected_lang = "";
	foreach($lang_list as $value){
		$lang = explode(";", $value);
		$sub_lang = explode("-", $lang[0]);
		$browser_lang = $sub_lang[0];
		if(file_exists(APP_ROOT.DS.$appInfo["location"].DS."_main".DS.CONFIG_DIR.DS.LANG_DIR.DS.$browser_lang.".xml")){
			$selected_lang = $browser_lang;
			break;
		}
	}

	if($selected_lang == ""){
		// load default language
		$selected_lang =  GET_CONFIG("language", "type");
	}

    // check global language file
    $lang_file = APP_ROOT.DS.$appInfo["location"].DS."_main".DS.CONFIG_DIR.DS.LANG_DIR.DS.$selected_lang.".xml";
    if(is_file($lang_file)){
        $xml = simplexml_load_file($lang_file);
        foreach($xml->word as $element){
            if($element["id"] == $sId){
                    return (string)$element["value"];
            }
        }
    }
    return $sId;
}

function SET_PAGE($page, $model){
	$nTotalCnt = $model->getCount();
	$pagePerRow = 10;
	$totalPage = ceil($nTotalCnt / $pagePerRow);
	$from = ($page - 1) * $pagePerRow;
	$count = $pagePerRow;

	$model->setLimit($from, $count);

	$next_page = intval($page) + 1;
	if($next_page >= $totalPage){
		$next_page = "";
	}
	
	return $next_page;
}   	
?>
