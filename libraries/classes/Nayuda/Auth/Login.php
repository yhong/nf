<?php
/*
* Login Class
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package AUTH
*/

class Nayuda_Auth_Login extends Nayuda_Object{
	private $login_email;
	private $username;
	private $password;
	private $fullname;
	
	private $ok;
	private $salt;
	private $oDBmg;

	public function __construct($table_name){
		$dsn = GET_CONFIG("database", "dsn");
		$id = GET_CONFIG("database", "id");
		$password = GET_CONFIG("database", "password");
		$this->oDBmg = new Nayuda_DB_Manage($dsn, $id, $password);

		$this->oDBmg->setTbName($table_name);
		$this->salt = GET_CONFIG("session", "salt");
		$this->login_email = "";
		$this->username = "Guest";
		$this->ok = false;
		
		return $this->ok;
	}
	
	public function checkSession(){
		if(SESSION()){
			return $this->check(SESSION('auth_username'), SESSION('auth_password'));
		}else{
			return false;
		}
	}

	public function login($login_email, $user_password){
		$check_query = "login_email = '".$login_email."' AND password = '".md5($user_password . $this->salt)."'";
		if($this->oDBmg->countConditionRecordRow($check_query) > 0){
			
			$this->fullname		= $this->oDBmg->getFieldValue("fullname", "login_email = '".$login_email."'");
			$this->people_id	= $this->oDBmg->getFieldValue("id", "login_email = '".$login_email."'");
			$this->login_email 	= $this->oDBmg->getFieldValue("login_email", "login_email = '".$login_email."'");
			$this->username 	= $this->oDBmg->getFieldValue("fullname", "login_email = '".$login_email."'");
			$this->ok = true;
		
			SESSION('auth_fullname', $this->fullname);
			SESSION('auth_people_id', $this->people_id);
			SESSION('auth_username', $login_email);
			SESSION('auth_password', md5($user_password . $this->salt));

			return true;
		}
		return false;
	}		

	public function check($login_email, $user_password){
		if($this->oDBmg->countConditionRecordRow("login_email = '".$login_email."'") == 1)
		{
			$db_password = $this->oDBmg->getFieldValue("password", "login_email = '".$login_email."'");

			if($db_password == $user_password)
			{	
				$this->fullname		= $this->oDBmg->getFieldValue("fullname", "login_email = '".$login_email."'");
				$this->people_id	= $this->oDBmg->getFieldValue("people_id", "login_email = '".$login_email."'");
				$this->login_email 	= $this->oDBmg->getFieldValue("login_email", "login_email = '".$login_email."'");
				$this->username 	= $this->oDBmg->getFieldValue("fullname", "login_email = '".$login_email."'");
				$this->ok = true;
				return true;
			}
		}			
		return false;
	}
	
	public function logout(){
		$this->login_email = 0;
		$this->username = "Guest";
		$this->ok = false;
		
		// clear session
		session_unset();
		session_destroy();

		if(!SESSION()){
			return true;
		}else{
			return false;
		}
		//$result = $this->checkSession();
	}
}
?>