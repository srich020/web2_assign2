<?php

class SubjectDB extends AbstractDB{
	protected function getSelect(){
		return 'Select SubjectID,SubjectName from Subjects ';
	}
	protected function getKeyFieldName(){
		return 'SubjectID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>