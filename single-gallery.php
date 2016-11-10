<?php 
//Author: Andrew Cruess, David Han, Sebastian Richters 
//Assignment 2
//COMP 3512 Fall 2016 

//--------Single Gallery PHP Page----------
?>

<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
$gallery = new SingleGallery();
$galleryDB = new GalleryDB($pdo);
	echo $gallery->makeGalleryHeader($_GET["id"],$pdo);
?>

<div class="ui container">
<div class="ui six column grid">
<div class="ui hidden divider"></div>
<?php
	
	echo '<div class="ui hidden divider"></div>';
	echo '<div class="ui container"><h2>Paintings</h2><div class="ui divider"></div>
	<div class="ui six column grid">';
	$a = new Reusable($pdo);
	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	/*default cards*/ $statement = $galleryDB->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','galleries USING(GalleryID)',2);
	echo $a->MakeCards($statement,2);
	}else{
	/*ID cards*/ $statement = $galleryDB->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','galleries USING(GalleryID)',$_GET["id"]);
	echo $a->MakeCards($statement,2);
	}
	echo '</div></div></div></div></div></div></body>';
	include "./inc/footer.inc.php";
	
?>