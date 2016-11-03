<?php
include_once 'AbstractDB.php';
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
}
?>