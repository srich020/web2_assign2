<?php

abstract class AbstractDB{
	abstract protected function getSelect();
	abstract protected function getKeyFieldName();
	private $connection;
	public function __construct($connect){
		$this->connection = $connect;
	}
	protected function getConnection(){
		return $this->connection;
	}
	public function getAll(){
		$statement = DBHelper::runQuery($this->getConnection(),$this->getSelect(),null);
		return $row = $statement->fetchAll();
	}
	public function findByID($id){
		$sql = $this->getSelect().' where '.$this->getKeyFieldName().' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}	
	public function findByIDOrder($id,$order){
		$sql = $this->getSelect().' where '.$this->getKeyFieldName().' =? Order By '.$order;
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}	
	public function findByIDWithKey($id,$keyfield){
		$sql = $this->getSelect().' where '.$keyfield.' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}	
	public function findByIDandJoin($field,$join,$id){
		$sql = 'SELECT '.$field.' JOIN '.$join.' where '.$this->getKeyFieldName().' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}
	public function findByIDandJoinWithKField($field,$join,$keyfield,$id){
		$sql = 'SELECT '.$field.' JOIN '.$join.' where '.$keyfield.' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}
	public function findByIDandJoinWithKFieldOrder($field,$join,$keyfield,$id,$order){
		$sql = 'SELECT '.$field.' JOIN '.$join.' where '.$keyfield.' =? Order By '.$order;
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}
	public function orderBy($order){
		$sql = $this->getSelect().' order by '.$order.';';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($order));
		return $statement;
	}

	
}
?>