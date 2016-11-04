<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Genres PHP Page----------
class BrowseGenres{
function ensureSafety($get,$pdo){
	$string = "";
	if(!isset($get)||empty($get)){
	$query = "SELECT * FROM Genres WHERE GenreID = ?;";
	$string .= $this->makeGenreHeader($query,1,$pdo);
	}else{
	$query = "SELECT * FROM Genres WHERE GenreID = ?;";
	$string .= $this->makeGenreHeader($query,$get['id'],$pdo);
	}
	return $string;
}

function makeGenreHeader($query,$get,$pdo){	
	$result = $pdo->prepare($query);
	$result-> bindValue(1,$get);
	$result-> execute();
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
	$pdo = null;			
	return $string;
}

}
?>