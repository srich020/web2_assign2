<?php 
//Author: Andrew Cruess 
//Assignment 2
//COMP 3512 Fall 2016 

//--------browse galleries PHP Page----------
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
        <h1 class="ui huge header">Galleries</h1>
    </div>  

</div>

<div class="ui container">
<div class="ui three column grid">

<?php
$i = new Reusable($pdo);
$gallery = new GalleryDB($pdo);
$statement = $gallery->orderBy('GalleryName');
echo $i->makeCards($statement,5);
echo '</div>
</div>';
include "./inc/footer.inc.php";

?>


