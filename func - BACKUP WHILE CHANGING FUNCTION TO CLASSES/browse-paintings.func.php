<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Paintings Function PHP Page----------
include 'db.func.php';

function browsePaintings($query, $pdo){
	$toReturn = "";
	$result = $pdo->query($query);
				while($row=$result->fetch()){
	$toReturn.= '
<div class="item">
	<div class="image">
		<img href="single-painting.php?id='.$row["PaintingID"].'" src="images/art/works/square-medium/'.$row["ImageFileName"].'.jpg">
		</div>
		<div class="content">
			<a class="header" href="single-painting.php?id='.$row["PaintingID"].'">'.utf8_encode($row["Title"]).'</a>
			<div class="meta">
				<span>'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</span>
			</div>
			<div class="extra">
				<p>'.utf8_encode($row["Excerpt"]).'</p>
			</div>
			<div class="description">$'.number_format($row["Cost"]).'

			</div>
			<div>
				<div class="ui hidden divider"></div>
				<button class="ui orange icon button"><i class="shop icon"></i></button>
				<button class="ui icon button"><i class="heart icon"></i></button>
			</div>
		</div>
	</div>

	<div class="ui divider"></div>';

	}
		$pdo = null;
		return $toReturn;
	}
	
	?>