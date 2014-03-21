<?php
/*
* Templete Class
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.3
* @access public
* @package Object
*/
class Nayuda_Template_Smarty extends Nayuda_Template_Abstract{
	private $mLayoutName = null;
	private $mSubLayoutName = null;
	private $mTplExt = null;
	private $_tpl = null;
	private static $instance = null;

	// construction
	public final function __construct(){
		$this->_tpl = new Smarty();

        #$this->_tpl->caching = true;
        #$this->_tpl->cache_lifetime = 3600;

        $main_app_info = GET_APP_INFO(MAIN_APP_NAME);

		$this->_tpl->template_dir = array(
                TPL_SCRIPT_PATH, 
                $this->getMainAppViewDir().DS.TPL_SCRIPT_DIR
        );

		$this->_tpl->compile_dir = TPL_COMPILE_PATH;
		$this->_tpl->cache_dir = TPL_CACHE_PATH;
		$this->_tpl->config_dir = NAYUDA_ROOT.DS.GET_CONFIG("template", "config");
		$this->_tpl->plugins_dir = array('plugins', 'sysplugins', NAYUDA_ROOT.DS.GET_CONFIG("template", "plugin"));

		$this->mTplExt = GET_CONFIG("template", "ext"); 
	}

    private function __clone(){}

    // Singleton pattern
    public static function getInstance(){
        if(!(self::$instance instanceof self)){
            self::$instance = new self(); 
        }
        return self::$instance;
    }

	// Set variable
	public function assign($id, $value = null){
		$this->_tpl->assign($id, $value);
	}

    private function getMainAppViewDir(){
        $main_app_info = GET_APP_INFO(MAIN_APP_NAME);
        return APP_ROOT.DS.$main_app_info["location"].DS.MAIN_APP_NAME.DS.VIEW_DIR;
    }

    private function getTplPath($path, $dir, $fileName){
        $sFile = $path.DS.$fileName.'.'.$this->mTplExt;
        if(!is_file($sFile)){
            $sFile = $this->getMainAppViewDir().DS.$dir.DS.$fileName.'.'.$this->mTplExt;
        }
        return $sFile;
    }

	// Set Layout
	public function setLayout($name, $subName = null){
		$this->mSubLayoutName = null;

		if($subName){
            $sSubLayoutFile = $this->getTplPath(TPL_LAYOUT_PATH, TPL_LAYOUT_DIR, $subName);
            $this->mSubLayoutName = "file:".$sSubLayoutFile;
		}

        $sLayoutFile = $this->getTplPath(TPL_LAYOUT_PATH, TPL_LAYOUT_DIR, $name);
		$this->mLayoutName = "file:".$sLayoutFile;
	}
	
    public function blockFetch($fileName){
        $sBlockFile = $this->getTplPath(TPL_BLOCK_PATH, TPL_BLOCK_DIR, $fileName);

        $sCacheId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");
        $sCompileId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");

        return $this->_tpl->fetch($sBlockFile, $sCacheId, $sCompileId);
    }

    public function errorDisplay($tpl_name){
        $sCacheId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");
        $sCompileId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");

        $sErrorFile = $this->getTplPath(TPL_ERROR_PATH, TPL_ERROR_DIR, $fileName);
		$sContentOutput = $this->_tpl->fetch("file:".$sErrorFile, $sCacheId, $sCompileId);

        $this->_tpl->assign("MAIN_CONTENTS", $sContentOutput);
        $this->_tpl->display($this->mLayoutName, $sCacheId, $sCompileId);
    }

	// Display for layout
	public function display($tpl_name){
        $sCacheId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");
        $sCompileId = SERVER("SERVER_NAME")."_".SERVER("REQUEST_URI");

        if(substr($sCacheId, -1) == DS){
            $sCacheId = substr($sCacheId, 0, -1);
        }
        if(substr($sCompileId, -1) == DS){
            $sCompileId = substr($sCompileId, 0, -1);
        }

		$sSubOutput = $this->_tpl->fetch($tpl_name.'.'.$this->mTplExt, $sCacheId, $sCompileId);

		if($this->mSubLayoutName){
			$this->_tpl->assign("SUB_CONTENTS", $sSubOutput);

			$sOutput = $this->_tpl->fetch($this->mSubLayoutName);
			$this->_tpl->assign("MAIN_CONTENTS", $sOutput);
		}else{
			$this->_tpl->assign("MAIN_CONTENTS", $sSubOutput);
		}

		$this->_tpl->display($this->mLayoutName, $sCacheId, $sCompileId);
	}
}
?>
