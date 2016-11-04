<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Genre PHP Page----------
?>

<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","srich020","srich020");
$pdo = DBHelper::createConnection($i);
?>

<div class="ui container">
<div class="ui six column grid">
<div class="ui hidden divider"></div>';
<?php
	$i = new BrowseGenres();
	$query = "Select * From Genres";
	echo $i->ensureSafety($_GET,$pdo);
	echo '<div class="ui container">
	<div class="ui six column grid">';
	$a = new Reusable();
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$query = "SELECT paintings.paintingID, ImageFileName FROM paintings JOIN paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID) WHERE GenreID = 1;";
	echo $a->MakeCards($query,2,$pdo);
	}else{
	$query = "SELECT paintings.paintingID, ImageFileName FROM paintings JOIN paintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID) WHERE GenreID =".$_GET["id"].";";
	echo $a->MakeCards($query,2,$pdo);
	}
	echo '</div></div></div></div></div></div></body>';
	include "./inc/footer.inc.php";
	
?>