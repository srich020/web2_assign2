<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Paintings PHP Page----------
 
include './inc/header.inc.php';
include 'func/browse-paintings.func.php';
include_once 'func/db.func.php';


?>

<html>
<body>
	<div class="ui hidden divider"></div>

	<div class="ui container grid">
		<div class="five wide column"><h3>FILTER</h3>
<form action="browse-paintings.php">
			<div class="ui divider"></div>
			<p><b>Artist</b></p>
			<select name="artist" class="ui fluid dropdown">
				<option value="0">Select Artist</option>

<?php
				$pdo = connectDB();
				$query = "SELECT FirstName,LastName,ArtistID from Artists;";
				$result = $pdo->query($query);
				while($row=$result->fetch()){
					
					echo '<option value="'.$row["ArtistID"].'">'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</option>';
				}
				?>
			</select>
			<div class="ui hidden divider"></div>
			<p><b>Museum</b></p>
			<select name="museum" class="ui fluid dropdown">
				<option value="0">Select Museum</option>
				<?php
				$result = $pdo->query("SELECT GalleryID,GalleryName from Galleries;");
				while($row=$result->fetch()){
					
					echo '<option value="'.$row["GalleryID"].'">'.utf8_encode($row["GalleryName"]).'</option>';
				}?>
			</select>
			<div class="ui hidden divider"></div>
			<p><b>Shape</b></p>
			<select name="shape" class="ui fluid dropdown">
				<option value="0">Select Shape</option>';
				
				<?php
				$result = $pdo->query("SELECT ShapeID, ShapeName from Shapes;");
				while($row=$result->fetch()){
					
					echo '<option value="'.$row["ShapeID"].'">'.utf8_encode($row["ShapeName"]).'</option>';
				}?>

			</select>
			<div class="ui hidden divider"></div>
			<button class="centered ui huge orange button" type="submit"><i class="filter icon"></i>Filter</button>
			</form>
		</div>

		<div class="eleven wide column grid">
			<h2>Paintings</h2>
			<div class="ui hidden divider"></div>
			<?php
			if(isset($_GET["artist"]) && $_GET["artist"]!=0){
				$sql = "SELECT FirstName, LastName from Paintings 
				JOIN Artists ON(Paintings.ArtistID = Artists.ArtistID) 
				WHERE Artists.ArtistID =?;";
				$result = $pdo->prepare($sql);
				$result->bindValue(1,$_GET["artist"]);
				$result->execute();
				$row=$result->fetch();
				echo '<p><b>ARTIST = '.$row["FirstName"].' '.$row["LastName"].'</b></p>';
			}else{
				echo '<p><b>ARTIST</b></p>';
			}
			echo '<div class="ui hidden divider"></div>
			<div class="ui items">';
			
			if(!isset($_GET)||empty($_GET)){
				$query = "SELECT * from Paintings JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID) ORDER BY RAND() LIMIT 20;";
				echo browsePaintings($query, $pdo);
				}else if(isset($_GET["artist"]) && $_GET["artist"]!=0){
				$query = "SELECT * from Paintings JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID) WHERE Paintings.ArtistID =".$_GET["artist"].";";
				echo browsePaintings($query, $pdo);	
				}else if(isset($_GET["museum"])&& $_GET["museum"]!=0){
				$query = "SELECT * from Paintings 
				JOIN Galleries ON (Paintings.GalleryID = Galleries.GalleryID)
				JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID)	
				WHERE Paintings.GalleryID =".$_GET["museum"].";";
				echo browsePaintings($query, $pdo);
				}else if(isset($_GET["shape"])&& $_GET["shape"]!=0){
				$query = "SELECT * from Paintings 
				JOIN Galleries ON (Paintings.GalleryID = Galleries.GalleryID)
				JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID)
				JOIN Shapes ON (Paintings.ShapeID = Shapes.ShapeID)	
				WHERE Paintings.ShapeID =".$_GET["shape"].";";
				echo browsePaintings($query, $pdo);
				}else{
				$query = "SELECT * from Paintings JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID) LIMIT 20;";
				echo browsePaintings($query, $pdo);
				}				
				echo '</div></div></body></html>';
				include "./inc/footer.inc.php";
			?>
			