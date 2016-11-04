<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Single Paintings Functions PHP Page----------
class SinglePainting{
function makeImage($get,$pdo){
			$result = $pdo->query("SELECT * FROM paintings WHERE paintingID =".$get.";");
			$row = $result->fetch();
             return '<img src="./images/art/works/medium/'.$row["ImageFileName"].'.jpg" alt="..." class="ui big image" id="artwork">
                
                <div class="ui fullscreen modal">
                  <div class="image content">
                      <img src="./images/art/works/large/'.$row["ImageFileName"].'.jpg" alt="..." class="image" >
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                
               
            </div>';
}
function shoppingCart($get,$pdo){
				$string = "";
				$result = $pdo->query("SELECT * from Paintings WHERE paintings.paintingID =".$get.";");
			$row = $result->fetch();
						$string .= '$'.number_format($row["Cost"]);	
                         $string .= '</div>
                        </div>
                        <div class="four fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number">
                            </div>';   			
				$pdo = null;
				return $string;
	
}

function makeBottomTable($get,$pdo){
			$string = "";
			$result = $pdo->query("SELECT * FROM paintings WHERE paintingID =".$get.";");
			$row = $result->fetch();
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
					$result = $pdo->query("SELECT * from Reviews WHERE PaintingID =".$get.";");
			$row = $result->fetch();
			while($row=$result->fetch()){
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
}

?>