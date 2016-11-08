<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Genre PHP Page----------
?>

<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
?>

<div class="ui container">
<div class="ui six column grid">
<div class="ui hidden divider"></div>
<?php
	$i = new BrowseGenres();
	$genre = new GenreDB($pdo);
	$query = "Select * From Genres";
	echo $i->ensureSet($_GET,$pdo);
	echo '<div class="ui container">
	<div class="ui six column grid">';
	$a = new Reusable($pdo);
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$statement = $genre->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID)',1);
	echo $a->MakeCards($statement,2);
	}else{
	$statement = $genre->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID)',$_GET["id"]);
	echo $a->MakeCards($statement,2);
	}
	echo '</div></div></div></div></div></div></body>';
	include "./inc/footer.inc.php";
	
?>