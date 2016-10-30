<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Artist PHP Page----------
include './inc/header.inc.php';
include "./func/db.func.php";
include './func/single-artist.func.php';
?>

<body><main><div class="ui container">
	<div class="ui six column grid">
		<div class="ui hidden divider"></div>';
		
<?php 
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$query = "SELECT * FROM Artists WHERE ArtistID = 1;";
	echo makeArtistHeader($query);
	}else{
	$query = "SELECT * FROM Artists WHERE ArtistID = ".$_GET["id"].";";
	echo makeArtistHeader($query);
	}
	echo '</div>
	</div>';
	echo '<div class="ui container">
	<div class="ui six column grid">';
	
	$query = "SELECT paintings.paintingID, ImageFileName 
	FROM paintings 
	JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID)
	WHERE Artists.ArtistID = ";
	
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$query .= "1;";
	echo MakeCards($query,2);
	}else{
	$query .= $_GET["id"].";";
	echo MakeCards($query,2);}
	echo '</div></div></main></body>';
	include "./inc/footer.inc.php";
?>