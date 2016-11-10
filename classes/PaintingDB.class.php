<?php

class PaintingDB extends AbstractDB{
	protected function getSelect(){
		return 'Select PaintingID,ArtistID,GalleryID,ImageFileName,Title,ShapeID,MuseumLink,AccessionNumber,CopyrightText,Description,Excerpt,YearOfWork,Width,Height,Medium,Cost,MSRP,GoogleLink,GoogleDescription,WikiLink from Paintings ';
	}
	protected function getKeyFieldName(){
		return 'PaintingID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
	public function JoinWithOrderBy($join,$order){
		$sql = 'Select * from Paintings'.' JOIN '.$join.' order by '.$order.';';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,Array($order));
		return $statement;
	}
		public function findSearchResults($searchTerm){
		$sql = 'Select * from paintings JOIN artists USING(ArtistID) WHERE title LIKE "%'.$searchTerm.'%" OR Description LIKE "%'.$searchTerm.'%"';
		$statement = DBHelper::runQuery($this->getConnection(),$sql,null);
		return $statement;
	}
}
?>