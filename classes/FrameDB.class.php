<?php

class FrameDB extends AbstractDB{
	protected function getSelect(){
		return 'Select FrameID,Title,Price,Color,Syle from TypesFrames ';
	}
	protected function getKeyFieldName(){
		return 'Title';
	}
	public function __construct($connect){
		parent::__construct($connect);
	}
}
?>