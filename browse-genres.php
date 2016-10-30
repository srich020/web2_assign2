<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Genres PHP Page----------
include './inc/header.inc.php';
include "./func/db.func.php";
?>

<div class="banner-container">

 <div class="ui text container">
        <h1 class="ui huge header">Genres</h1>
    </div>  

</div>

<div class="ui container">
<div class="ui six column grid">

<?php
$query = "SELECT * FROM Genres ORDER BY EraID, GenreName;";
echo makeCards($query,0);//in db.func.php

echo '</div>
</div>';

include "./inc/footer.inc.php";

?>


