<?php

class ArtistDB extends AbstractDB{
	
	protected function getSelect(){
		return 'Select ArtistID,FirstName,LastName,Nationality,Gender,YearOfBirth,YearOfDeath,Details,ArtistLink from Artists ';
	}
	protected function getKeyFieldName(){
		return 'ArtistID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
	
	public function findByIDandJoin($field,$join,$id){//changed to include use for specified columns
		$specifiedArtist = "Artists.ArtistID";
		$sql = 'SELECT '.$field.' JOIN '.$join.' where Artists.ArtistID =?';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($id));
		return $statement;
	}
}
?>