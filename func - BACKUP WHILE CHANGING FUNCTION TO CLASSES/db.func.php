<?php
//Author: Sebastian Richters 
//Assignment 1
//COMP 3512 Fall 2016 

//--------Overall functions page----------
function connectDB(){
	try{
	$connString = "mysql:host=localhost;dbname=art";
	$user = "srich020";
	$pswd = "srich020";
	$pdo = new PDO($connString,$user,$pswd);
	$pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
	return $pdo;
	}catch(PDOException $ex){
		die($ex->getMessage());
	}
	}
//this is used in more than one page to generate card divs
function makeCards($query,$i){
	$pdo = connectDB();
	$result = $pdo->query($query);
	$string = "";
	
	while($row=$result->fetch()){
	$string .= '<div class="column">';

			if($i == 0){

			$string .= '
		<a class="ui card" href="single-genre.php?id='.$row["GenreID"].'">
			<div class="image">
				<img src="./images/art/genres/square-medium/'.$row["GenreID"].'.jpg">
				</div>
				<div class="content">'.utf8_encode($row["GenreName"]).'</div>
			</a>
		</div>';
			}else{
			$string .= '
		<a class="ui card" href="single-painting.php?id='.$row["paintingID"].'">
			<div class="image">
				<img src="./images/art/works/square-medium/'.$row["ImageFileName"].'.jpg">
				</div>
			</a>
		</div>';	
			}

	}
	$pdo = null;
	return $string;
}
	function makeFilter($table,$type){
	$pdo = connectDB();
	$string = '<div class="four wide field"><label>'.$type.'</label>
                                <select id="'.$type.'" class="ui search dropdown">
								';
	$result = $pdo->query("SELECT Title from ".$table." ORDER BY ".$type."ID desc;");
			while($row=$result->fetch()){
				  $string .='<option>'.utf8_encode($row["Title"]).'</option>';
			}					
								
         $string .='</select>
                            </div>';
		return $string;
}
?>