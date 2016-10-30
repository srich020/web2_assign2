<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Index PHP Page----------

include './inc/header.inc.php';?>

<body>
<div class="hero-container">
    <div class="ui text container">
        <h1 class="ui huge header">Decorate your world</h1>
        <a href='browse-paintings.php' class="ui huge orange button" >Shop Now</a>
    </div>  
</div>  
<h2 class="ui horizontal divider"><i class="tag icon"></i> Deals</h2>   
    
<main>    

<form action="single-genre.php" method="get">

<div class="ui three column centered grid">
  <div class="four wide column">
  <div class="ui centered card">
  <img class="ui medium bordered image" src="images/art/works/medium/107050.jpg">
  <div class="content">
    <div class="header">Experience the sensuous pleasures of the French Rococco</div>
  </div>
  <div class="extra content">
    <button class="fluid ui button" name="id" type="submit" value="83"><i class="info circle icon"></i>See More</button>
  </div>
</div>
  </div>
  
<div class="four wide column">
<div class="ui centered card">
  <img class="ui medium bordered image" src="images/art/works/medium/126010.jpg">
  <div class="content">
    <div class="header">Appeciate the quiet beauty of the Dutch Golden Age</div>
  </div>
  <div class="extra content">
    <button class="fluid ui button" name="id" type="submit" value="87"><i class="info circle icon"></i>See More</button>
  </div>
</div>
</div>

<div class="four wide column">
<div class="ui centered card">
  <img class="ui medium bordered image" src="images/art/works/medium/100030.jpg">
  <div class="content">
    <div class="header">Discover the glorious color of the Renaissance</div>
  </div>
   <div class="extra content">
    <button class="fluid ui button" name="id" type="submit" value="78"><i class="info circle icon"></i>See More</button>
  </div>
</div>
</div>

</div>

</form>

</main>
</body>
</html>

<?php include "./inc/footer.inc.php"; ?>