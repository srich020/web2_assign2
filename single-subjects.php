<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Subject PHP Page----------
?>

<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
$subject = new SingleSubject();
?>

<div class="ui container">
<div class="ui six column grid">
<div class="ui hidden divider"></div>
<?php
	$subjectData = new SubjectDB($pdo);
	$reuse = new Reusable($pdo);
	echo $subject->makeSubjectHeader($_GET["id"],$pdo);
	echo '<div class="ui container">
	<div class="ui six column grid">';

	if(!isset($_GET)||empty($_GET)||!is_numeric($_GET["id"])){
	$statement = $subjectData->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','paintingSubjects ON (Paintings.PaintingID = PaintingSubjects.PaintingID)',1);
	echo $reuse->MakeCards($statement,2);
	}else{
	$statement = $subjectData->findByIDandJoin('paintings.paintingID, ImageFileName FROM paintings','paintingSubjects ON (Paintings.PaintingID = PaintingSubjects.PaintingID)',$_GET["id"]);
	echo $reuse->MakeCards($statement,2);
	}
	echo '</div></div></div></div></div></div></body>';
	include "./inc/footer.inc.php";
	
?>