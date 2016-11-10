<?php 
//Author: Andrew Cruess 
//Assignment 2
//COMP 3512 Fall 2016 

//--------Single Gallery Class----------

class SingleGallery{	
public $i = null;
private $reuse;
function makeGalleryHeader($parameter,$i){	
	$this->reuse = new Reusable($i);
	$gallery = new GalleryDB($i);
	$result = $gallery->findByID($parameter);
	$string = "";
	$row = $result->fetch();
	$string .='<div class="ui hidden divider"></div>
		<section class="ui segment grey100">
		<div class="ui container"> 
		
			<div class="ui items">
				<div class="item">
						<div class="content">
							<h1 class="huge header">'.utf8_encode($row["GalleryName"]).'</h1>
							<div class="meta">
								<span>'.utf8_encode($row["GalleryCity"].', '.$row["GalleryCountry"]).'</span>
							</div>
							<div class="description">
							<p><a href="'.$row["GalleryWebSite"].'">'.utf8_encode($row["GalleryNativeName"]).'</a></p>
							</div>
						</div>
				</div>
				<div class="item" id="map">';
				/*Map Generation start*/
				$string.='<script>
				  function initMap() {
					var mapGallery = {lat: '.$row["Latitude"].', lng: '.$row["Longitude"].'};
					var map = new google.maps.Map(document.getElementById("map"), {
					  zoom: 13,
					  center: mapGallery
					});
					var marker = new google.maps.Marker({
					  position: mapGallery,
					  map: map
					});
				  }
				</script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_AvnEfs049PJYIz59o1TUqkSZz3hDxrk&callback=initMap">
				</script>';
				
	$string.='</div>
			</div>
			</section>';		
	return $string;
}
}








