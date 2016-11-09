<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Genres PHP Page----------

class SingleSubject{	
public $i = null;
private $reuse;
function makeSubjectHeader($parameter,$i){	
	$this->reuse = new Reusable($i);
	$subject = new SubjectDB($i);
	$result = $subject->findByID($parameter);
	$string = "";
	$row = $result->fetch();
	$string .= 
'<div class="ui hidden divider"></div>
		<div class="ui container"> 
			<div class="ui items">
				<div class="item">
					<div class="image">
						<img src="./images/art/works/square-medium/'.$this->reuse->getSubjectPicture($parameter).'.jpg">
						</div>
						<div class="content">
							<a class="huge header">'.utf8_encode($row["SubjectName"]).'</a>
							<div class="meta">
								<span></span>
							</div>
							<div class="description">
								<p></p>
							</div>
						</div>
					</div>
				</div>
				<div class="ui hidden divider"></div>
				<h2>Paintings</h2>
				<div class="ui divider"></div>';		
	return $string;
}
}