<?php
include_once 'AbstractDB.php';
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
}
?>