<?php
// gloval Controller
class Nayuda_Controller extends Nayuda_Object{
	protected $oDb = null; 		// DB object variable
	protected $oDbConn = null; 	// DB member object variable
	protected $oTpl = null; 	// DB template object variable
	protected $oLogin = null;
	protected $mArrParam = null;
	
   	public function __construct($arrParam = null) {
		$this->makeConnection();
		$this->setTemplate($arrParam);
		$this->setAuth();
	}

	protected function makeConnection(){
		// make connection 
		$dsn = GET_CONFIG("database", "dsn");
		$id = GET_CONFIG("database", "id");
		$password = GET_CONFIG("database", "password");

        try{
		    $this->oDb = new Nayuda_DB_Manage($dsn, $id, $password);
		    $this->oDbConn = $this->oDb->getConResource();

        }catch(PDOException $err){
            print $err;
		}
	}

	protected function setTemplate($arrParam){
		// Template Object (loading by singleton)
		$this->oTpl = Nayuda_Template_Smarty::getInstance();
		//$this->oTpl = new Nayuda_Template_Smarty();
		$this->oTpl->setLayout("blank");

        $this->oTpl->assign("MAIN_DOMAIN", MAIN_DOMAIN);
        $this->oTpl->assign("PEOPLE_ID", SESSION("auth_people_id"));
        $this->oTpl->assign("FULL_NAME", SESSION("auth_fullname"));

		$this->oTpl->assign("JS", JS_URL);
		$this->oTpl->assign("CSS", CSS_URL);
		$this->oTpl->assign("IMG", IMG_URL);
		$this->oTpl->assign("FILES", FILE_DIR);
		$this->oTpl->assign("FILE_ICON", FILE_ICON_URL);
		
		$this->mArrParam = $arrParam;
		$this->oTpl->assign("CONTROLLER", $arrParam["controller"]);
		$this->oTpl->assign("ACTION", $arrParam["action"]);
		if(array_key_exists("param", $arrParam)){
			$this->oTpl->assign("PARAM", $arrParam["param"]);
		}else{
			$this->oTpl->assign("PARAM", "");
		}
		
		// add the javascript and the style sheet
		$this->oTpl->assign("STYLE", "");
		$this->oTpl->assign("JAVASCRIPT", "");
	}

	protected function setAuth(){
		// login object
		$this->oLogin = new Nayuda_Auth_Login("user");
	}
	
	public function __destruct() {
       		// disconnect from the DB
		$this->oDbConn = null;
   	}
}
?>
