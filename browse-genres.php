<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Genres PHP Page----------

include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
?>

<div class="banner-container">

 <div class="ui text container">
        <h1 class="ui huge header">Genres</h1>
    </div>  

</div>

<div class="ui container">
<div class="ui six column grid">

<?php
$i = new Reusable($pdo);
$genre = new GenreDB($pdo);
$statement = $genre->orderBy('EraID, GenreName');
echo $i->makeCards($statement,0);
echo '</div>
</div>';

include "./inc/footer.inc.php";

?>


