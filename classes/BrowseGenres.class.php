<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Genres PHP Page----------

class BrowseGenres{	
public $i = null;
function ensureSet($get,$pdo){
	$i = $pdo;
	$genreDB = new GenreDB($i);
	$string = "";
	if(!isset($get)||empty($get)){
	$query = "SELECT * FROM Genres WHERE GenreID = ?;";
	$string .= $this->makeGenreHeader(1,$i);
	}else{
	$query = "SELECT * FROM Genres WHERE GenreID = ?;";
	$string .= $this->makeGenreHeader($get['id'],$i);
	}
	return $string;
}

function makeGenreHeader($parameter,$i){	
	$genreDB = new GenreDB($i);
	$result = $genreDB->findByID($parameter);
	$string = "";
	$row = $result->fetch();
	$string .= 
'<div class="ui hidden divider"></div>
		<div class="ui container"> 
			<div class="ui items">
				<div class="item">
					<div class="image">
						<img src="./images/art/genres/square-medium/'.$row["GenreID"].'.jpg">
						</div>
						<div class="content">
							<a class="huge header">'.utf8_encode($row["GenreName"]).'</a>
							<div class="meta">
								<span>'.utf8_encode($row["Description"]).'</span>
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
?>