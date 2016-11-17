<?php

class GlassDB extends AbstractDB{
	protected function getSelect(){
		return 'Select GlassID,Title,Description,Price from TypesGlass ';
	}
	protected function getKeyFieldName(){
		return 'Title';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>