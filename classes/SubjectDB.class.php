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
		$sql = 'SELECT DISTINCT SubjectName, subjects.SubjectID FROM subjects INNER JOIN paintingsubjects ON subjects.subjectID
		WHERE paintingsubjects.PaintingID =' . $pId .';';
		$statement = DBHelper::runQuery($this->getConnection(),$sql);
		return $statement;
	}
}
?>