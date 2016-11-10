<?php 
//Author: Sebastian Richters, Andrew Cruess, David han
//Assignment 2
//COMP 3512 Fall 2016 

//--------Single Paintings PHP Page----------
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
$painting = new SinglePainting($pdo);
$paintingdata = new PaintingDB($pdo);
$reuse = new Reusable($pdo);
?>
<div class="banner-container">

 <div class="ui text container">
        <h1 class="ui huge header">Subjects</h1>
    </div>  

</div>

<div class="ui container">
<div class="ui six column grid">

<?php
$i = new Reusable($pdo);
$subject = new SubjectDB($pdo);
$statement = $subject->orderBy('SubjectName');
echo $i->makeCards($statement,4);
echo '</div>
</div>';
include "./inc/footer.inc.php";

?>


