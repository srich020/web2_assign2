<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Genre PHP Page----------
?>

<?php
include './inc/header.inc.php';
include_once "./func/db.func.php";
include_once "./func/browse-genres.func.php";
?>

<div class="ui container">
<div class="ui six column grid">
<div class="ui hidden divider"></div>';
<?php
	$query = "Select * From Genres";
	echo ensureSafety($_GET);
	echo '<div class="ui container">
	<div class="ui six column grid">';

	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$query = "SELECT paintings.paintingID, ImageFileName FROM paintings JOIN paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID) WHERE GenreID = 1;";
	echo MakeCards($query,2);
	}else{
	$query = "SELECT paintings.paintingID, ImageFileName FROM paintings JOIN paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID) WHERE GenreID =".$_GET["id"].";";
	echo MakeCards($query,2);
	}
	echo '</div></div></div></div></div></div></body>';
	include "./inc/footer.inc.php";
	
?>