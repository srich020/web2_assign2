<?php
include_once 'AbstractDB.class.php';
class GenreDB extends AbstractDB{
	protected function getSelect(){
		return 'Select GenreID,GenreName,EraID,Description,Link from Genres ';
	}
	protected function getKeyFieldName(){
		return 'GenreID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>