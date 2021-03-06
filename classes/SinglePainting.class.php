<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Paintings Functions PHP Page----------
class SinglePainting{
private $artist;
private $connect;
private $painting;
public function __construct($connect){
$this->connect = $connect;
$this->artist = new ArtistDB($connect);
$this->painting = new PaintingDB($connect);
$this->reviews = new ReviewDB($connect);
$this->subjects = new SubjectDB($connect);
}
function makeImage($get){
			$statement = $this->painting->findByID($get);
			$row = $statement->fetch();
             return '<img src="./images/art/works/medium/'.$row["ImageFileName"].'.jpg" alt="..." class="ui big image" id="artwork">
                
                <div class="ui basic modal">
                  <div class="image content">
                      <img src="./images/art/works/large/'.$row["ImageFileName"].'.jpg" alt="..." class="image" >
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                
               
            </div>';
}
function shoppingCart($get){
				$string = "";
				$statement = $this->painting->findByID($get);
				$row = $statement->fetch();
						$string .= '$'.number_format($row["Cost"]);	
                         $string .= '</div>
                        </div>
                        <div class="four fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="1">
                            </div>';   			
				return $string;
	
}

function makeBottomTable($get){
			$string = "";
			$statement = $this->painting->findByID($get);
			$row = $statement->fetch();
            $string .= utf8_encode($row["Description"]). 
            '</div>
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                          Wikipedia Link
                      </td>
                      <td>
                        <a href="'.$row["WikiLink"].'">View painting on Wikipedia</a>
                      </td>                       
                      </tr>                       
                      
                      <tr>
                     <td>
                          Google Link
                      </td>
                      <td>
                        <a href="'.$row["GoogleLink"].'">View painting on Google Art Project</a>
                      </td>                       
                      </tr>
                      
                      <tr>
                     <td>
                          Google Text
                      </td>
                      <td>'.utf8_encode($row["GoogleDescription"]).
							
                      '</td>                       
                      </tr>                      
                      
   
       
                  </tbody>
                </table>
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">';
				$review = new ReviewDB($this->connect);
					$statement = $review->findByIDWithKey($get,'PaintingID');
			while($row = $statement->fetch()){
				$date = date_create($row["ReviewDate"]);
				 $string .=  '<div class="event">
					<div class="content">
						<div class="date">'.date_format($date,'d/m/y').'</div>
						<div class="meta">
							<a class="like">';
							$rating = $row["Rating"];
							for($x = 0; $x < $rating; $x++){
								$string .= '<i class="star icon"></i>';
							}
						$string .=	'</a>
						</div>                    
						<div class="summary">'.utf8_encode($row["Comment"]).'
									

							</div>       
					</div>
				  </div>
				<div class="ui divider"></div>';
			}		
	$pdo = null;	
	return $string;
}

function getPaintingAvgRating($get)
	{
		$avg;
		$count=0;
		$total=0;
		
		$statement = $this->reviews->findByID($get);
		while($row = $statement->fetch()){
			$total = $total + $row["Rating"];
			$count++;
		}
		if($count >0){
			$avg = round($total/$count);
		}
		else
		{
			$avg = 0;
		}

		
		return $avg;
	}

function outputPaintingSubjects($get){
	$statement = $this->subjects->getAllPaintingSubjects($get);
		while($row = $statement->fetch()){
			echo '<li class="item"><a href="single-subjects.php?id=' .$row[1] .'">'. $row[0] .'</a></li>';
		}
}



function outputRatingStars($get)
	{
		
		$count = $this->getPaintingAvgRating($get);
							
		for($i = 0 ; $i < $count; $i++)
		{
			echo '<i class="orange star icon"></i>';
		}
		
		for($i = 5 ; $i > $count; $i--)
		{
			echo '<i class="empty star icon"></i>';
			
		}
	}


}

?>