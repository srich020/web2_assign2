<?php

class ShapeDB extends AbstractDB{
	protected function getSelect(){
		return 'Select ShapeID,ShapeName from Shapes ';
	}
	protected function getKeyFieldName(){
		return 'ShapeID';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>