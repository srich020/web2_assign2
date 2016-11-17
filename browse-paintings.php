<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Browse Paintings PHP Page----------
 
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art","sadsquad","sadsquad");
$pdo = DBHelper::createConnection($i);
$paintings = new PaintingDB($pdo);
$artists = new ArtistDB($pdo);
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
				$artists = new ArtistDB($pdo);
				$statement = $artists->orderBy("LastName");
				while($row = $statement->fetch()){
					echo '<option value="'.$row["ArtistID"].'">'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</option>';
				}

				?>
			</select>
			<div class="ui hidden divider"></div>
			<p><b>Museum</b></p>
			<select name="museum" class="ui fluid dropdown">
				<option value="0">Select Museum</option>
				<?php
				$gallery = new GalleryDB($pdo);
				$statement = $gallery->orderBy("GalleryName");
				while($row = $statement->fetch()){
					echo '<option value="'.$row["GalleryID"].'">'.utf8_encode($row["GalleryName"]).'</option>';
				}
				?>
			</select>
			<div class="ui hidden divider"></div>
			<p><b>Shape</b></p>
			<select name="shape" class="ui fluid dropdown">
				<option value="0">Select Shape</option>';
				<?php
				$shapes = new ShapeDB($pdo);
				$statement = $shapes->orderBy("ShapeName");
				while($row = $statement->fetch()){
					echo '<option value="'.$row["ShapeID"].'">'.utf8_encode($row["ShapeName"]).'</option>';
				}
				?>

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
				$result = $artists->findByIDOrder($_GET["artist"],"LastName");
				$row=$result->fetch();
				echo '<p><b>ARTIST = '.$row["FirstName"].' '.$row["LastName"].'</b></p>';
			}elseif(isset($_GET["shape"]) && $_GET["shape"]!=0){
				$shape = new ShapeDB($pdo);
				$result = $shape->findByIDOrder($_GET["shape"],"ShapeName");
				$row=$result->fetch();
				echo '<p><b>SHAPE = '.$row["ShapeName"].'</b></p>';
			}elseif(isset($_GET["museum"]) && $_GET["museum"]!=0){
				$museum = new GalleryDB($pdo);
				$result = $museum->findByIDOrder($_GET["museum"],"GalleryName");
				$row=$result->fetch();
				echo '<p><b>MUSEUM = '.$row["GalleryName"].'</b></p>';
			}else{
				echo '';
			}
			// if(isset($_GET["artist"]) && $_GET["artist"]!=0){
				// $result = $artists->findByID($_GET["artist"]);
				// $row=$result->fetch();
				// echo '<p><b>ARTIST = '.$row["FirstName"].' '.$row["LastName"].'</b></p>';
			// }else{
				// echo '<p><b>ARTIST</b></p>';
			// }
			echo '<div class="ui hidden divider"></div>
			<div class="ui items">';
			$browse = new BrowsePainting();
			if(!isset($_GET)||empty($_GET)){
				$statement = $paintings->joinWithOrderBy('Artists ON (Paintings.ArtistID = Artists.ArtistID)','YearOfWork ASC LIMIT 20');
				echo $browse->browsePaintings($statement);
			}else if(isset($_GET["artist"]) && $_GET["artist"]!=0){
				$statement = $paintings->findByIDandJoinWithKFieldOrder('* from Paintings','Artists ON (Paintings.ArtistID = Artists.ArtistID)','Paintings.ArtistID',$_GET["artist"],"YearOfWork ASC");
				echo $browse->browsePaintings($statement);	
			}else if(isset($_GET["museum"])&& $_GET["museum"]!=0){
				$statement = $paintings->findByIDandJoinWithKFieldOrder('* from Paintings','Galleries ON (Paintings.GalleryID = Galleries.GalleryID) JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID)','Paintings.GalleryID',$_GET["museum"],"YearOfWork ASC");
				echo $browse->browsePaintings($statement);
			}else if(isset($_GET["shape"])&& $_GET["shape"]!=0){
				$statement = $paintings->findByIDandJoinWithKFieldOrder('* from Paintings','Galleries ON (Paintings.GalleryID = Galleries.GalleryID) JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID) JOIN Shapes ON (Paintings.ShapeID = Shapes.ShapeID)','Paintings.ShapeID',$_GET["shape"],"YearOfWork ASC");
				echo $browse->browsePaintings($statement);
			}else if(isset($_GET["search"])&& !empty($_GET["search"])){
				$statement = $paintings->findSearchResults($_GET["search"]);
				echo $browse->browsePaintings($statement);
			}				
				echo '</div></div></body></html>';
				include "./inc/footer.inc.php";
			?>
			