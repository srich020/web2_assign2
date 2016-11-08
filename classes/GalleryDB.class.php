<?php

class GalleryDB extends AbstractDB{
	protected function getSelect(){
		return 'Select * from Galleries ';
	}
	protected function getKeyFieldName(){
		return 'GalleryID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
	
}
?>