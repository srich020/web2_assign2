<?php
include_once 'DBHelper.class.php';
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
		$statement = DBHelper::runQuery($this->getConnection(),$this->getSelect,null);
		return $row = $statement->fetchAll();
	}
	public function findByID($id){
		$sql = $this->getSelect().' where '.$this->getKeyFieldName().' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}	
	public function findByIDandJoin($field,$join,$id){
		$sql = 'SELECT '.$field.' '.$join.' where '.$this->getKeyFieldName().' =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}
}
?>