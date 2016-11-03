<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Artist Function PHP Page----------
include_once 'db.func.php';
function makeArtistHeader($query){
$pdo = connectDB();	
$result = $pdo->query($query);
$string = "";
$row = $result->fetch();
$string .= 
'<div class="ui hidden divider"></div>
				<div class="ui container"> 
					<div class="ui items">
						<div class="item">
							<div class="image">
								<img src="./images/art/artists/square-medium/'.$row["ArtistID"].'.jpg">
								</div>
								<div class="content">
									<div class="ui top attached tabular menu">
										<a class="item active" data-tab="first">Life</a>
										<a class="item" data-tab="second">Details</a>
									</div>
									<div class="ui bottom attached tab segment active" data-tab="first">
										<table class="ui definition very basic collapsing celled table">
											<tbody>
												<tr>
													<td>
							  Artist Name
													</td>
													<td>
							'.utf8_encode($row["FirstName"]).' '.utf8_encode($row["LastName"]).'
													</td>                       
												</tr>
												<tr>                       
													<td>
							  Born
													</td>
													<td>
							'.$row["YearOfBirth"].'
													</td>
												</tr>       
												<tr>
													<td>
							  Died
													</td>
													<td>
							'.$row["YearOfDeath"].'
													</td>
												</tr>  
												<tr>
													<td>
							  Nationality
													</td>
													<td>
							'.utf8_encode($row["Nationality"]).'
													</td>
												</tr>        
											</tbody>
										</table>
									</div>
									<div class="ui bottom attached tab segment" data-tab="second">
  '.utf8_encode($row["Details"]).'
									</div>
								</div>
							</div>
							<div class="ui hidden divider"></div>
							<h2>Paintings</h2>
							<div class="ui divider"></div>';
	$pdo = null;
	return $string;
}
?>