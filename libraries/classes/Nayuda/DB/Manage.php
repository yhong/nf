<?php
/*
* Managing Database Class
*
* @author Hong Young Hoon <eric.hong81@gmail.com>;
* @version 0.2
* @access public
* @package DB
*/


class Nayuda_DB_Manage extends Nayuda_DB_Connect{   
	
    // connect db with contruct method
	function DB_Manage($dsn, $id, $pass){
		parent::DB_Connect($dsn, $id, $pass);

	}


	/**
	 *  
	 * setWhereEQU()
	 * set condition of query
	 * private
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $isstring		: whether string or not(true : string / false:integer)
	 *
	 * @return $whereis		: return field array
	*/
	public function setWhereEQU($fieldname, $fieldvalue, $isstring=true){
		if($fieldvalue){
		  if($this->whereis){
			$this->whereis .= " and ";
		  }
		  if($isstring == true){
			$this->whereis .= $fieldname."='".$fieldvalue."'";
		  }else{
			$this->whereis .= $fieldname."=".$fieldvalue;
		  }
		}
	}


	/**
	 *  
	 * addSearchEQUField()
	 * set condition of query
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 * @param $isstring		: whether string or not(true : string / false:integer)
	 *
	 * @return $whereis		: return field array
	*/
	protected function addSearchEQUField($fieldname, $fieldvalue, $whereis, $isstring=true){
		if($fieldvalue){
		  if($whereis){
			$whereis .= " and ";
		  }
		  if($isstring == true){
			$whereis .= $fieldname."='".$fieldvalue."'";
		  }else{
			$whereis .= $fieldname."=".$fieldvalue;
		  }
		}
		return $whereis;
	}

	/**
	 *  
	 * addSearchALLLIKEField()
	 * set condition of query(String only)
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 *
	 * @return $whereis		: return field array
	*/
	protected function addSearchALLLIKEField($fieldname, $fieldvalue, $whereis){
		if($fieldvalue){
		  if($whereis){
			$whereis .= " and ";
		  }
		  $whereis .= $fieldname." like '%".$fieldvalue."%'";
		}
		return $whereis;
	}

	/**
	 *  
	 * addSearchLIKEField()
	 * set condition of query(string only)
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 *
	 * @return $whereis		: return field array
	*/
	protected function addSearchLIKEField($fieldname, $fieldvalue, $whereis){
		if($fieldvalue){
		  if($whereis){
			$whereis .= " and ";
		  }
		  $whereis .= $fieldname." like '".$fieldvalue."%'";
		}
		return $whereis;
	}

	/**
	 *  
	 * addSearchBETWEENField()
	 * set condition of query(string only)
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 *
	 * @return $whereis		: return field array
	*/
	protected function addSearchBETWEENField($fieldname, $fieldvalue1, $fieldvalue2, $whereis){
		if($fieldvalue1 || $fieldvalue2){
		  if($whereis){
			$whereis .= " and ";
		  }
		  if(!$fieldvalue1 && $fieldvalue2){
			   $whereis .= $fieldname." < '".$fieldvalue2."'";
		  }
		  else if($fieldvalue1 && !$fieldvalue2){
			   $whereis .= $fieldname." > '".$fieldvalue1."'";
		  }
		  else if($fieldvalue1 && $fieldvalue2){
			 $whereis .= $fieldname." BETWEEN '".$fieldvalue1."' AND '".$fieldvalue2."'";
		  } 
		}
		return $whereis;
	}
	/**
	 *  
	 * addSearchBETWEENField()
	 * set condition of query(string only)
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 * @param $seperator	: the seperator for a date
	 *
	 * @return $whereis		: return field array
	*/
	protected function addSearchBETWEENDateField($fieldname, $fieldvalue1, $fieldvalue2, $whereis, $seperator){
		if($fieldvalue1 || $fieldvalue2){
		  if($whereis){
			$whereis .= " and ";
		  }
		  if(!$fieldvalue1 && $fieldvalue2){
			   $whereis .= $fieldname." < '".$fieldvalue2.$seperator."12".$seperator."31'";
		  }
		  else if($fieldvalue1 && !$fieldvalue2){
			   $whereis .= $fieldname." > '".$fieldvalue1.$seperator."01".$seperator."01'";
		  }
		  else if($fieldvalue1 && $fieldvalue2){
			 $whereis .= " (".$fieldname2." between '".$fieldvalue1.$seperator."01".$seperator."01' and '".$fieldvalue2.$seperator."12".$seperator."31')";
		  }
		}
		return $whereis;
	}

	/**
	 *  
	 * addSearchBETWEENField()
	 * set condition of query(string only)
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	: the name of field
	 * @param $fieldvalue	: the value of field
	 * @param $whereis		: the value of condition
	 * @param $seperator	: the seperator for a date
	 *
	 * @return $whereis		: return field array	
	*/
	protected function addSearchBETWEENDate2Field($fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $whereis, $seperator){
		if($fieldvalue1 || $fieldvalue2){
		  if($whereis){
			$whereis .= " and ";
		  }
		  if(!$fieldvalue1 && $fieldvalue2){
			   $whereis .= $fieldname2." < '".$fieldvalue2.$seperator."12".$seperator."31'";
		  }
		  else if($fieldvalue1 && !$fieldvalue2){
			   $whereis .= $fieldname1." > '".$fieldvalue1.$seperator."01".$seperator."01'";
		  }
		else if($fieldvalue1 && $fieldvalue2){
			 $whereis .= "(".$fieldname2." between '".$fieldvalue1.$seperator."01".$seperator."01' and '".$fieldvalue2.$seperator."12".$seperator."31')";
		  }
		}
		return $whereis;
	}

	/**
	 *  
	 * searchTypeCheck()
	 * check part or all in a condition of the query
	 * private
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $checkValue	: checking the input value whether like or equal
	 *
	 * @return 		: bool
	*/
	private function searchTypeCheck($checkValue){
		if(substr($checkValue,-1,1) == '%'){
			return true;
		}else{
			return false;
		}
	}

	protected function searchLikeorEqu($fieldValue, $value, $whereis, $isString){
		if($this->searchTypeCheck($value) == true){
			$value = substr($value, 0, -1);
			$whereis = $this->addSearchLIKEField($fieldValue,$value,  $whereis, $isString);
		}else{
			$whereis = $this->addSearchEQUField($fieldValue,	$value,  $whereis, $isString);
		}
		return $whereis;
	}


	/**
	 *  
	 * countRecordRow()
	 * return the result of query
	 * public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $result_num : number of record in query
	*/
	public function countTotalRecordRow(){
		if($this->whereis){
			$cntsql = "select count(*) from ".$this->tb_name." where ".$this->whereis;
		}else{
			$cntsql = "select count(*) from ".$this->tb_name;
		}
		$result = $this->db_conn->query($cntsql);
		$result_num = $result->fetchColumn();

		return $result_num;
	}

	/**
	 *  
	 * SumRecordRow()
	 * sum
	 * public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $field : field name
	 *
	 * @return $result_num : sum of query result
	*/
	public function SumRecordRow($field){
		if($this->whereis){
			$cntsql = "select SUM(".$field.") from ".$this->tb_name." where ".$this->whereis;
		}else{
			$cntsql = "select SUM(".$field.") from ".$this->tb_name;
		}
		$result = $this->db_conn->query($cntsql);
		$result_num = $result->fetchColumn();

		return $result_num;
	}



	/**
	 *  
	 * TotalRecordRow()
	 * result of row 
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $total_num : number of result
	*/
	public function TotalRecordRow(){

		$cntsql = "select count(*) from ".$this->tb_name;
		$result = $this->db_conn->query($cntsql);
		$total_num = $result->fetchColumn();
		return $total_num;
	}

	/**
	 *  
	 * countConditionRecordRow()
	 *return a data of count with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $total_num : record number of query
	*/
	public function countConditionRecordRow($whereis){
		if($whereis){
			$cntsql = "select count(*) from ".$this->tb_name." where ".$whereis;
		}else{
			$cntsql = "select count(*) from ".$this->tb_name;
		}
		$result = $this->db_conn->query($cntsql);
		$total_num = $result->fetchColumn();
		
		return $total_num;
	}

	/**
	 *  
	 * countMaxNum()
	 * return a data of sum with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	
	 * @param $whereis		
	 *
	 * @return $total_num : max value
	*/
	public function countMaxNum($fieldname, $whereis){
		if($whereis){
			$cntsql = "select max($fieldname) from ".$this->tb_name." where ".$whereis;
		}else{
			$cntsql = "select max($fieldname) from ".$this->tb_name;
		}
		$result = $this->db_conn->query($cntsql);
		$total_num = $result->fetchColumn();
		
		if(!$total_num){$total_num = 0;}

		return $total_num;
	}

	/**
	 *  
	 * countMaxNum()
	 * return a data of sum with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname	
	 * @param $whereis		
	 *
	 * @return $total_num : max value
	*/
	public function countSumNum($fieldname, $whereis){
		if($whereis){
			$cntsql = "select sum($fieldname) from ".$this->tb_name." where ".$whereis;
		}else{
			$cntsql = "select sum($fieldname) from ".$this->tb_name;
		}
		$result = $this->db_conn->query($cntsql);
		$total_num = $result->fetchColumn();
	
		if(!$total_num){$total_num = 0;}

		return $total_num;
	}

	/**
	 *  
	 * getFieldValue()
	 * return a data with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param $fieldname 
	 * @param $whereis	
	 *
	 * @return $one_value : return value
	*/
	public function getFieldValue($fieldname, $whereis){
		if($whereis){
			$sql = "select ".$fieldname." from ".$this->tb_name." where ".$whereis;
		}else{
			$sql = "select ".$fieldname." from ".$this->tb_name;
		}

		$result = $this->db_conn->query($sql);
        $value = null;
        if($result){
            $value = $result->fetchColumn();
        }

		return $value;
	}
	
	/**
	 *  
	 * getFieldValue()
	 * return a data with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param null
	 *
	 * @return $aValue[0] : return value
	*/
	public function getRowValue(){
		if($this->whereis){
			$this->query = "select ".$this->field_kind." from ".$this->tb_name." where ".$this->whereis;
		}else{
			$this->query = "select ".$this->field_kind." from ".$this->tb_name;
		}
		$result = $this->db_conn->query($this->query);
		$value = $result->fetch();

		return $value;
	}
	
	
	/**
	 *  
	 * getFieldValues()
	 * return datas with condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param null
	 *
	 * @return $values : return row
	*/
	public function getRowValues(){
		if(!$this->field_kind){
			$field_kind = "*";
		}else{
			$field_kind = $this->field_kind;
		}

		if($this->order_by){
			$order_by = "order by ".$this->order_by;
		}else{
			$order_by = "";
		}
				
		if($this->limit){
			$limit = "limit ".$this->limit;
		}else{
			$limit = "";
		}

		if($this->whereis){
			$this->query = "select ".$field_kind." from ".$this->tb_name." where ".$this->whereis.' '.$order_by.' '.$limit;
		}else{
			$this->query = "select ".$field_kind." from ".$this->tb_name.' '.$order_by.' '.$limit;
		}

		try{
			$pResult = $this->db_conn->prepare($this->query);

			$pResult->execute();
			$values = $pResult->fetchAll();
		
			return $values;

		}catch(PDOException $err){
			print $err;
		}
	}
	
	/**
	 *  
	 * countConditionRecordRow()
	 * return the number which excuted query with the condition
	 * @access public
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @param nothing
	 *
	 * @return $total_num : number of record
	*/
	public function getRowCount(){
		if($this->whereis){
			$cntsql = "select count(*) from ".$this->tb_name." where ".$this->whereis;
		}else{
			$cntsql = "select count(*) from ".$this->tb_name;
		}
		$result = $this->db_conn->prepare($cntsql);
		$result->execute();
		$cnt =  $result->fetchColumn(0);

		return $cnt;
	}
	
	/**
	 * select()
	 * execute the select query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param string $table : table name
	 * @param array $condition : where part  ex) array(field => value, ...)
	 * @return bool
	*/
	public function selectOne($table, $fields, $condition = null){ 
		try{
			// making field list
			$fieldList = "";
			if(is_array($fields)){
				foreach($fields as $field){
					$fieldList .= $field.",";
				}
				$fieldList = substr($fieldList, -1);
			}else{
				$fieldList = $fields;
			}

			// makeing where statement
			$where = "";
			$values = array();
			foreach($condition as $key=>$value){
				if(is_array($value)){
					$where .= $key.$value[0]."?";
					array_push($values, $value[1]);
				}else{
					$where .= $key."=?";
					array_push($values, $value);
				} 
				$where .= " and ";
			}
			$where = substr($where, 0, -5);
			
			// getting whole statement
			$prepare_sql = "select ".$fieldList." from ".$table." where ".$where;
			$result = $this->db_conn->prepare($prepare_sql);
			$result->execute($values);

			return $result->fetch(PDO::FETCH_ASSOC);

		}catch(PDOException $err){
			print $err;
		}
	}

	/**
	 * delete()
	 * execute the delete query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param string $table : table name
	 * @param array $condition : where part  ex) array(field => value, ...)
	 * @return bool
	*/
	public function delete($table, $condition){ 
		try{
			$where = "";
			$values = array();
			foreach($condition as $key=>$value){
				if(is_array($value)){
					$where .= $key.$value[0]."?";
					array_push($values, $value[1]);
				}else{
					$where .= $key."=?";
					array_push($values, $value);
				} 
				$where .= " and ";
			}
			$where = substr($where,0, -5);

			$prepare_sql = "delete from ".$table." where ".$where;
			$result = $this->db_conn->prepare($prepare_sql);

			return $result->execute($values);

		}catch(PDOException $err){
			print $err;
		}
	}

	/**
	 * insert()
	 * execute the insert query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param string $table : table name
	 * @param array $data : value list  ex) array(field => value, ...)
	 * @param array $relate_fields : relate field  ex) array(field=>anothoer field, ...)
	 * @return bool
	*/
	public function insert($table, $data, $relate_fields = null){ 
		$fields = "";
                $values = "";

                foreach($data as $key=>$val) {
                        $fields .= $key.", ";
                        $values .= ":".$key.", ";
                }

		if($relate_fields != null){
			foreach($relate_fields as $key=>$val) {
				$fields .= $key.", ";
				$values .= $val.", ";
			}
		}

                $fields = substr($fields, 0, -2);
                $values = substr($values, 0, -2);

		try{
			$prepare_sql = "insert into ".$table."(".$fields.") values (".$values.")";
			$result = $this->db_conn->prepare($prepare_sql);

			return $result->execute($data);

		}catch(PDOException $err){
			print $err;
		}
	}
	

	/**
	 * update()
	 * execute the insert query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param string $table : table name
	 * @param array $data : value list  ex) array(field => value, ...)
	 * @param array $relate_fields : relate field  ex) array(field=>anothoer field, ...)
	 * @return bool
	*/
	public function update($table, $data, $primary_key="id", $relate_fields = null){ 
		$fields = "";
        $values = "";

        foreach($data as $key=>$val) {
            if($primary_key == $key){
                continue;
            }
            $values .= $key."=:".$key.", ";
        }

		if($relate_fields != null){
            if($primary_key == $key){
                continue;
            }
			foreach($relate_fields as $key=>$val) {
				$values .= $key."=".$val.", ";
			}
		}

        $values = substr($values, 0, -2);

		try{
			$prepare_sql = "update ".$table." set ".$values." where ".$primary_key."=:".$primary_key;
			$result = $this->db_conn->prepare($prepare_sql);

			return $result->execute($data);

		}catch(PDOException $err){
			print $err;
		}
	}

	/**
	 * insertQuery()
	 * execute the insert query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param nothing
	 * @return bool
	*/
	public function insertQuery(){ 
		if(!$this->tb_name){
			die("You should set the name of table!");
		}

		if(empty($this->data)){	
			die("It's wrong parameter!");
		}else{
			$this->setFieldAndValue($this->data);
		}

		try{
			$prepare_sql = "insert into ".$this->tb_name."(".$this->field_kind.") values (".$this->value_list.")";
			$result = $this->db_conn->prepare($prepare_sql);

			$this->input_query_result = $result->execute($this->data);

			return $this->input_query_result;

		}catch(PDOException $err){
			print $err;
		}
	}
	
	/**
	 *  
	 * updateQuery()
	 * execute the update query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param nothing
	 * @return bool
	*/
	public function updateQuery(){ 
		
		if(!$this->tb_name){
			die("you should set the name of table!");
		}
		if(empty($this->data)){	
			die("It's wrong parameter!");
		}else{
			$this->setFieldAndValueForSet($this->data);
		}

		$prepare_sql = "update ".$this->tb_name." set ".$this->value_list." where ".$this->whereis;

		try{
			$result = $this->db_conn->prepare($prepare_sql);
			$this->input_query_result = $result->execute($this->data);
			
			return $this->input_query_result;

		}catch(PDOException $err){
			print $err;
		}
	}
	
	/**
	 *  
	 * deleteQuery()
	 * execute the delete query
	 * 
	 * @author eric hong(eric.hong81@gmail.com)
	 * @access public
	 * @param nothing
	 * @return bool
	*/
	public function deleteQuery(){ 
		
		if(!$this->tb_name){
			die("you should set the name of table!");
		}
		if(empty($this->data) || empty($this->type)){	
			die("It's wrong parameter!");
		}else{
			$this->setFieldAndValueForWhere($this->data);
		}

		$prepare_sql = "delete from ".$this->tb_name." where ".$this->value_list;

		try{
			$result = $this->db_conn->prepare($prepare_sql, $this->type);

			$this->input_query_result = $result->execute($this->data);
			
			return $this->input_query_result;

		}catch(PDOException $err){
			print $err;
		}
	}
	
} // END DBManage class
?>
