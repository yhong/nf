<?php

class index_controller extends Nayuda_Controller{
	function __construct($arrParam) {
		 parent::__construct($arrParam);
		 $this->oTpl->setLayout("default");
	}

   	
   	public function index(){
		$this->oTpl->display("index");
   	}
}
?>
