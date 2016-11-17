<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Paintings Function PHP Page----------
class BrowsePainting{
function browsePaintings($result){
	// $painting = new PaintingDB($pdo);
$toReturn = "";
	// $result = $pdo->query($query);
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
				<a href="shopping-cart.php?action=add&id='.$row["PaintingID"].'&quantity=1"><button class="ui orange icon button"><i class="shop icon"></i></button></a>
	<a href="favorites-list.php?action=add&type=painting&id='.$row["PaintingID"].'"><button class="ui icon button"><i class="heart icon"></i></button></a>
			</div>
		</div>
	</div>

	<div class="ui divider"></div>';

	}
		return $toReturn;
	}
}
	?>