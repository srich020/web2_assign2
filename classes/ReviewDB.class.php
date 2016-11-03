<?php
include_once 'AbstractDB.php';
class ReviewDB extends AbstractDB{
	protected function getSelect(){
		return 'Select RatingID,PaintingID,ReviewDate,Rating,Comment from Reviews ';
	}
	protected function getKeyFieldName(){
		return 'RatingID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>