<?php
/*
* DB connection class
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package DB
*/

class Nayuda_DB_Connect extends Nayuda_Object{
	
   /**
    * variables of databases
    * @var string
    * @see DBConnect()
    */
	protected $dsn;
	protected $db_conn;
	protected $tb_name;
	protected $query;
	protected $type = array();
	protected $data = array();
	protected $order_by;
	protected $limit;
	protected $arr_field = array();		// table field information
	protected $setPrepare;
	
	public $field_kind;
	public $value_list;
	public $whereis;  
	
	protected $input_query_result;  // DB::result()


	/**
    * connect a datadase
    *
    * @author eric hong(eric.hong81@gmail.com)
    * @param String DSN value
    * @return nothing
    * @access public
    * @see $dsn
    */
	function __construct($dsn, $id, $password){
		$this->dsn  = $dsn;

		try{
		    $this->db_conn = new PDO($dsn, $id, $password);
		
		    // prepare for the syntax
		    $this->setPrepare = false;
		
		}catch(PDOException $err){
			echo $err;
		}
	}

	/**
	 *  
	 * getConResource()
	 * return the table name which is setted in config
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing 
	 *
	 * @return $db_conn : connection object
	*/
	public function getConResource(){
		return $this->db_conn;
	}
	
	/**
	 *  
	 * setDSN()
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $dsn : dsn name
	 *
	 * @return nothing
	*/
	public function setDSN($dsn){
		$this->dsn = $dsn;

	}
	
	/**
	 *  
	 * getDSN()
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing 
	 *
	 * @return $dsn : dsn name
	*/
	// 
	public function getDSN(){
		return $this->dsn;

	}

	/**
	 *  
	 * setTbName()
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $tbname : table name
	 *
	 * @return nothing
	*/
	public function setTbName($tbname){
		$this->type = array();
		$this->data = array();
		//$this->whereis = null;
		$this->tb_name = $tbname;

	}
	
	/**
	 *  
	 * getTbName()
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing 
	 *
	 * @return $tb_name : table name
	*/
	// 
	public function getTbName(){
		return $this->tb_name;

	}

	/**
	 *  
	 * addField($field, $value)
	 * set the field and value
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param nothing
	 * @return nothing
	*/
	public function addField($field, $value){
		$this->data = array_merge($this->data, array($field=>$value));

		$this->setPrepare = true;
	}
	
	/**
	 *  
	 * addFieldAndType($field, $value, $type)
	 * set the field and value
	 * type=>true :string  / type=>true : number
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param nothing
	 * @return nothing
	*/
	// TODO : drop this function
	public function addFieldAndType($field, $value, $type){
		$this->data = array_merge($this->data, array($field=>$value));

		if($type == true){
			array_push($this->type, "text");
		}else{
			array_push($this->type, "integer");
		}
		$this->setPrepare = true;
	}

	/**
	 *  
	 * setField()
	 * field name ("alias"=>"dbfieldname")
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $arrFieldValue : field name(array)
	 *
	 * @return nothing
	*/
	// 
	public function setField($sFieldValue){
		$this->field_kind = $sFieldValue;
	}

	public function setFieldAndValue($arrValue){
		$field_kind = "";
		$value_list = "";

		foreach($arrValue as $key=>$val) {
			 $field_kind.= $key.", ";
			 $value_list.= ":".$key.", ";
		}

		$this->field_kind =  substr($field_kind, 0, -2);
		$this->value_list =  substr($value_list, 0, -2);

		$this->setPrepare = true;
	}

	public function setFieldByArray($arrFieldValue){
		$field_kind = "";

		for($i=0;$i<count($arrFieldValue);$i++){
			$field_kind.=$arrFieldValue[$i].",";
		}

		$field_kind = substr($field_kind, 0, -1);

		$this->field_kind = $field_kind;
	}
	
	public function setFieldByValue($value){
		$this->field_kind = $value;
	}
	
	public function setFieldAndValueForWhere($arrValue){
		$field_kind = "";
		$value_list = "";

		foreach($arrValue as $key=>$val) {
			$field_kind.= $key.", ";
			$value_list.= $key." = :".$key." and ";
		}

		$this->field_kind =  substr($field_kind, 0, -2);
		$this->value_list =  substr($value_list, 0, -5);

		$this->setPrepare = true;
	}
	
	public function setFieldAndValueForSet($arrValue){
		$field_kind = "";
		$value_list = "";

		foreach($arrValue as $key=>$val) {
				 $field_kind.= $key.", ";
				 $value_list.= $key." = :".$key.", ";
		}

		$this->field_kind =  substr($field_kind, 0, -2);
		$this->value_list =  substr($value_list, 0, -2);

		$this->setPrepare = true;
	}
	
	
	
	public function setType($arrTypeValue){
		$this->type = $arrTypeValue;
	}
	
	/**
	 *  
	 * getField()
	 * concaterate the column with ','
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $field_kind : return the field character
	*/
	public function getField(){
		return $this->field_kind;
	}

	/**
	 *  
	 * setWhere()
	 * set the filter string
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $inputValue : input string
	 *
	 * @return $query : 쿼리값
	*/
	public function setWhere($sValue){
		$this->whereis = $sValue;
	}

	/**
	 *  
	 * getWhere()
	 * return the filter string
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $this->condition	: concaterate with '`' character
	*/
	public function getWhere(){
		return $this->whereis;
	}
	
	
	/**
	 *  
	 * setQuery()
	 * set the query string 
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $value : query string
	 *
	 * @return nothing
	*/
	public function setQuery($value){
		$this->query = $value;
	}

	/**
	 *  
	 * getQuery()
	 * return the query string
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $query : query string
	*/
	public function getQuery(){
		return $this->query;
	}
	
	/**
	 *  
	 * setOrder()
	 * set the "Order by" 
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $value : query string
	 *
	 * @return nothing
	*/
	public function setOrderBy($value){
		$this->order_by= $value;
	}

	/**
	 *  
	 * getOrder()
	 * return the "Order by"
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $query : query
	*/
	public function getOrderBy(){
		return $this->order_by;
	}
	
	
	public function setAddwhereis($value){
		if($this->whereis){
			$this->whereis .= " and ".$value;
		}else{
			$this->whereis = $value;
		}
	}
	
	/* 
	 * exe_query()
	 * execute query(check the page or list)
	 *
	 * @access private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $from, $count : start, count
	 *
	 * @return nothing
	*/
	public function exe_query($from, $count){
		if(!$count || $count == 0){
			$this->executeQuery();
		}else{
			$this->executeLimitQuery($from, $count);
		}
	}
	
	/**
	 * executeQuery()
	 * execute query
	 * 
	 * 
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param void
	 * @return void
	*/
	public function executeQuery(){ 
		try{
			$this->input_query_result = $this->db_conn->exec($this->query);

		}catch(PDOException $err){
			echo $err;
		}
	}


	/**
	 *  
	 * getQueryResult()
	 * return the result of query
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param void
	 * @return $input_query_result : the number of the record in query
	*/
	public function getQueryResult(){ 
		return $this->input_query_result;
	}

	/**
	 *  
	 * DBClose()
	 * Return data of row which returned the result of query
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param void
	 * @return void
	*/
	public function DBClose(){
		$this->db_conn->disconnect();
	}
	
	/**
	 *  
	 * lastInsertID()
	 * Get last id which inputed at last time
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param void
	 * @return void
	*/
	public function lastInsertID(){
		return $this->db_conn->lastInsertId();
	}
	
	public function setLimit($rows, $offset){
		if($rows != null && $rows != 0){
			$rows = ",".$rows;
		}
		$this->limit = $offset.$rows;
	}
	
	public function getLimit(){
		return $this->limit;
	}
}
?>
