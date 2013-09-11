<?php
/*
* Page load Class 
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package System
*/

class Nayuda_System_Loader extends Nayuda_Object{
	/**
	 * basic URL
	 *
	 * @var string
	 * @access public
	 */
	public $controllerPostfix= "controller";

	public function __construct($url = null) {
		// fix the basic value with index
        $arrParam = array();

        if($url){
            if(substr($url, -1)  == '/'){
                $url = substr($url, 0, -1);
            }
            $arrUrl = explode('/', $url);
        }

        $path = "";
        foreach($arrUrl as $idx=>$item){
            $path .= $item;
            $include_file = CONTROLLER_PATH.DS.$path."_".$this->controllerPostfix.".php";
            if(FILE_EXISTS_IN_PATH($include_file)){
                require_once($include_file);
                break;
            }else{
                $path .= DS;
            }
        }
        if(substr($path, -2)  == '//'){
            $path = substr($path, 0, -1);
        }


        if(!FILE_EXISTS_IN_PATH($include_file)){
            $_include_file = CONTROLLER_PATH.DS.$path."index_".$this->controllerPostfix.".php";
            
            if(FILE_EXISTS_IN_PATH($_include_file)){
                $arrParam["controller"] = "index";
                $arrParam["action"] = "index";
                $path .= $arrParam["controller"];
            }else{
                die("the path(".$_include_file.") does not exist!");
            }
        }else{
            $arrParam["controller"] = $arrUrl[$idx];
            if(array_key_exists(($idx + 1), $arrUrl)){
                $arrParam["action"] = $arrUrl[$idx + 1];

                if(count($arrUrl) - ($idx + 2) == 1){
                    $arrParam["param"] = $arrUrl[$idx+2];
                }else if(count($arrUrl) - ($idx + 2) > 1){
                    $arrParam["param"] = array_slice($arrUrl, ($idx + 2));
                }
            }else{
                $arrParam["action"] = "index";
            }
        }
        $arrParam["controller.class"] = $arrParam["controller"]."_".$this->controllerPostfix;
        $arrParam["controller.file"] = $arrParam["controller.class"].".php";

		$include_file = CONTROLLER_PATH.DS.$path."_".$this->controllerPostfix.".php";

        // loading super class (if it exists)
		$_include_file = CONTROLLER_PATH.DS."controller.php";
        if(FILE_EXISTS_IN_PATH($_include_file)){
                require_once($_include_file);
        }
		
        // loading controller
		if(FILE_EXISTS_IN_PATH($include_file)){
			require_once($include_file);

            // check the parameter(s)
			if (class_exists($arrParam["controller.class"])) {
				$obj = new $arrParam["controller.class"]($arrParam);
				if(method_exists($obj, $arrParam["action"])){
                    if(array_key_exists("param", $arrParam)){
                        if(count($arrParam["param"]) > 0){
                            $obj->{$arrParam["action"]}($arrParam["param"]);
                            return;
                        }
                    }
                    $obj->{$arrParam["action"]}();
				}else{
					die($arrParam["action"]."() is not defined in ".$include_file);
				}
				
			}else{
					die($arrParam["controller"]." class could not find in ".$include_file."file.");
			}
		}else{
			die("There is not file for loading! (".$include_file.")");
		}
	}
}
?>
