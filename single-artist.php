<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Artist PHP Page----------
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","srich020","srich020");
$pdo = DBHelper::createConnection($i);
$artist = new SingleArtist();
$reuse = new Reusable($pdo);
$artistDB = new ArtistDB($pdo)
?>

<body><main><div class="ui container">
	<div class="ui six column grid">
		<div class="ui hidden divider"></div>
		
<?php 
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$query = "SELECT * FROM Artists WHERE ArtistID = 1;";
	echo $artist->makeArtistHeader(1,$pdo);
	}else{
	$query = "SELECT * FROM Artists WHERE ArtistID = ".$_GET["id"].";";
	echo $artist->makeArtistHeader($_GET["id"],$pdo);}
	echo '</div>
	</div>';
	echo '<div class="ui container">
	<div class="ui six column grid">';
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$statement = $artistDB->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','Artists ON (Paintings.ArtistID = Artists.ArtistID)',1);
	echo $reuse->MakeCards($statement,2);
	}else{
	$statement = $artistDB->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','Artists ON (Paintings.ArtistID = Artists.ArtistID)',$_GET["id"]);
	echo $reuse->MakeCards($statement,2);
	echo '</div></div></main></body>';
	}
	include "./inc/footer.inc.php";
?>