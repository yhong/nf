<?php

class main_controller extends Nayuda_Controller{
	function __construct($arrParam) {
		 parent::__construct($arrParam);
		 $this->oTpl->setLayout("default");
	}
	function __destruct() {
       parent::__destruct();
   	}
	
   	
   	public function index(){
		$this->oTpl->display("main/index");
   	}
}
?>