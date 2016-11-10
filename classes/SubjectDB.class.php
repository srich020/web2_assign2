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

	public function getAllPaintingSubjects($pId)
	{
		$sql = 'SELECT SubjectName, subjects.SubjectID FROM paintingsubjects,subjects 
                WHERE subjects.SubjectID = paintingsubjects.SubjectID
                AND paintingsubjects.PaintingID = ' . $pId . ';';
		$statement = DBHelper::runQuery($this->getConnection(),$sql);
		return $statement;
	}
}
?>