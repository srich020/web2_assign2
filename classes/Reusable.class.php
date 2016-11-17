<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Overall functions page----------

//this is used in more than one page to generate card divs

class Reusable extends AbstractDB{
private $connect;
function makeCards($statement,$i){
	$string = "";
	while($row=$statement->fetch()){
	$string .= '<div class="column">';
			if($i == 0){
			$string .= '
		<a class="ui card" href="single-genre.php?id='.$row["GenreID"].'">
			<div class="image">
				<img src="./images/art/genres/square-medium/'.$row["GenreID"].'.jpg">
				</div>
				<div class="content">'.utf8_encode($row["GenreName"]).'</div>
			</a>
		</div>';
			}elseif($i == 2){
			$string .= '
		<a class="ui card" href="single-painting.php?id='.$row["paintingID"].'">
			<div class="image">
				<img src="./images/art/works/square-medium/'.$row["ImageFileName"].'.jpg">
				</div>
			</a>
		</div>';	
			}elseif($i == 1){
				$string .= '<a class="ui card" href="single-artist.php?id='.$row["ArtistID"].'">
			<div class="image">
				<img src="./images/art/artists/square-medium/'.$row["ArtistID"].'.jpg">
				</div>
				<div class="content">'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</div>
			</a>
		</div>';	
			}elseif($i == 4){
				$string .= '<a class="ui card" href="single-subjects.php?id='.$row["SubjectID"].'">
			<div class="image">
				<img src="./images/art/works/square-medium/'.$this->getSubjectPicture($row['SubjectID']).'.jpg">
				</div>
				<div class="content">'.utf8_encode($row["SubjectName"]).'</div>
			</a>
		</div>';	
			}elseif($i == 5){
				//'<a class="ui card" href="single-gallery.php?id='.$row["GalleryID"].'">
				$string.='<a class="ui card" href="single-gallery.php?id='.$row["GalleryID"].'">
					<div class="content">
					  <div class="header">'.utf8_encode($row["GalleryName"]).'</div>
					  <div class="description">'.utf8_encode($row["GalleryCity"]).', '.utf8_encode($row["GalleryCountry"]).'
					  </div>
					</div>
					<div class="ui bottom attached button">
					  <i class="info circle icon"></i>
					  More Information
					
				  </div></a></div>';
			}
	}
	return $string;
}
	function makeFilter($table,$type){
	$string = '<div class="four wide field"><label>'.$type.'</label>
                                <select id="'.$type.'" class="ui search dropdown" id="material" name="'.$type.'">
								';
	$sql = "SELECT Title from ".$table." ORDER BY ".$type."ID desc;";
	$result = DBHelper::runQuery($this->connect,$sql,Array());
			while($row=$result->fetch()){
				  $string .='<option value="'.$row["Title"].'">'.utf8_encode($row["Title"]).'</option>';
			}					
								
         $string .='</select>
                            </div>';
		return $string;
}
	protected function getSelect(){
		return 'null';
	}
	protected function getKeyFieldName(){
		return 'null';
	}
		public function __construct($connect){
		parent::__construct($connect);
		$this->connect = $connect;
	}
	function getSubjectPicture($subjectId){
		$limit = $subjectId.'RAND() Limit 1';
		$toreturn = '';
		$subject = new SubjectDB($this->connect);
		$works = $subject->findByIDandJoinWithKField('ImageFileName FROM Subjects','PaintingSubjects ON (Subjects.SubjectID = PaintingSubjects.SubjectID) JOIN Paintings ON (PaintingSubjects.PaintingID = Paintings.PaintingID)','PaintingSubjects.SubjectID',$limit);
		$painting = $works->fetch();
		if($painting == null){
			return "085030";
		}else{
		return $painting["ImageFileName"];
		}
	}
}
?>