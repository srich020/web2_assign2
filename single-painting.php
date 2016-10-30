<?php 
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Paintings PHP Page----------
include './inc/header.inc.php';
include_once 'func/single-painting.func.php';
?>

<body>
	<main>
		<!-- Main section about painting -->
		<section class="ui segment grey100">
			<div class="ui doubling stackable grid container">

				<div class="nine wide column">';

					<?php 
			$get = null;		
			if(!isset($_GET['id'])||empty($_GET['id'])||!is_numeric($_GET["id"])){
				$get = 25;
			}else{
				$get = $_GET["id"];
			}
			
			echo makeImage($get);

			echo	'<div class="seven wide column">';

			$pdo = connectDB();
			$result = $pdo->query("SELECT paintings.*,galleries.*,artists.* FROM paintings 
			RIGHT JOIN Galleries ON (Paintings.GalleryID = Galleries.GalleryID) 
            JOIN Artists ON (Paintings.ArtistID = Artists.ArtistID)
			WHERE paintingID =".$get.";");
			$row = $result->fetch();
               echo '<div class="item">
					<h2 class="header">'.$row["Title"].'</h2>
					<h3>'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</h3>';?>

					<div class="meta">
						<p>
							<i class="orange star icon"></i>
							<i class="orange star icon"></i>
							<i class="orange star icon"></i>
							<i class="orange star icon"></i>
							<i class="empty star icon"></i>
						</p>

						<?php
						echo '<p>'.utf8_encode($row["Excerpt"]).'</p>'; 
						?>

					</div>  
				</div>                          

				<!-- Tabs For Details, Museum, Genre, Subjects -->
				<div class="ui top attached tabular menu ">
					<a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
					<a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
					<a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
					<a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
				</div>

				<div class="ui bottom attached active tab segment" data-tab="details">
					<table class="ui definition very basic collapsing celled table">
						<tbody>
							<tr>
								<td>
							  Artist
								</td>
								<td>
									<?php echo '<a href="single-artist.php?id='.$row["ArtistID"].'">'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'</a>
						  </td>                       
						  </tr>
						<tr>                       
						  <td>
							  Year
						  </td>
						  <td>
							'.$row["YearOfWork"].'
						  </td>
						</tr>       
						<tr>
						  <td>
							  Medium
						  </td>
						  <td>
							'.$row["Medium"].'
						  </td>
						</tr>  
						<tr>
						  <td>
							  Dimensions
						  </td>
						  <td>
							'.$row["Width"].'cm x '.$row["Height"].'cm
						  </td>
						</tr>        
					  </tbody>
					</table>
                </div>
				
				
			<div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                      <tbody>
                        <tr>
                          <td>
                              Museum
                          </td>
                          <td>
                            '.utf8_encode($row["GalleryName"]).'
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              Assession #
                          </td>
                          <td>
                            '.$row["AccessionNumber"].'
                          </td>
                        </tr>  
                        <tr>
                          <td>
                              Copyright
                          </td>
                          <td>
                            '.utf8_encode($row["CopyrightText"]).'
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              URL
                          </td>
                          <td>
                            <a href="'.$row["MuseumLink"].'">View painting at museum site</a>
                          </td>
                        </tr>        
                      </tbody>
                    </table>    
                </div>';    

$result = $pdo->query("SELECT Genres.GenreName,PaintingGenres.GenreID FROM paintings 
			JOIN PaintingGenres ON (Paintings.PaintingID = PaintingGenres.PaintingID) 
            JOIN Genres ON (PaintingGenres.GenreID = Genres.GenreID)
			WHERE paintings.paintingID =".$get.";");
			$row = $result->fetch();
				
                echo '<div class="ui bottom attached tab segment" data-tab="genres">
 
                        <ul class="ui list">
                          <li class="item"><a href="single-genre.php?id='.$row["GenreID"].'">'.$row["GenreName"];
						  ?>
								</a></li>
						</ul>

					</div>  
					<div class="ui bottom attached tab segment" data-tab="subjects">
						<ul class="ui list">
							<li class="item"><a href="#">People</a></li>
							<li class="item"><a href="#">Science</a></li>
						</ul>
					</div>  

					<!-- Cart and Price -->
					<div class="ui segment">
						<div class="ui form">
							<div class="ui tiny statistic">
								<div class="value">
									<?php						  
				$pdo = null;	
			echo shoppingCart($get);
            echo makeFilter("TypesFrames","Frame");                
			echo makeFilter("TypesGlass","Glass");
			echo makeFilter("TypesMatt","Matt");						
                                 
?>
								</div>                     
							</div>

							<div class="ui divider"></div>

							<button class="ui labeled icon orange button">
								<i class="add to cart icon"></i>
                      Add to Cart
							</button>
							<button class="ui right labeled icon button">
								<i class="heart icon"></i>
                      Add to Favorites
							</button>        
						</div>     <!-- END Cart -->                      

					</div>	
				</div>	
			</section>	

			<!-- Tabs for Description, On the Web, Reviews -->
			<section class="ui doubling stackable grid container">
				<div class="sixteen wide column">


					<div class="ui top attached tabular menu ">
						<a class="active item" data-tab="first">Description</a>
						<a class="item" data-tab="second">On the Web</a>
						<a class="item" data-tab="third">Reviews</a>
					</div>
					<div class="ui bottom attached active tab segment" data-tab="first">

						<?php
			echo makeBottomTable($get);
			?>
					</div>   <!-- END Reviews Tab -->          

				</div>        
			</section>
			<section class="ui container">
				<h3 class="ui dividing header">Related Works</h3>        
			</section>

		</main>    
		<?php
			include "./inc/footer.inc.php";
			
			echo '</body>
			</html>';
			?>