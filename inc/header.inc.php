<!--Header Page
Author: Sebastian Richters
Assignment 1
COMP 3512 Fall 2016 
-->

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
</head>

<header>
    <div class="ui attached stackable grey inverted  menu">
        <div class="ui container">
            <nav class="right menu">            
                <div class="ui simple  dropdown item">
                  <i class="user icon"></i>
                  Account
                    <i class="dropdown icon"></i>
                  <div class="menu">
                    <a class="item"><i class="sign in icon"></i> Login</a>
                    <a class="item"><i class="edit icon"></i> Edit Profile</a>
                    <a class="item"><i class="globe icon"></i> Choose Language</a>
                    <a class="item"><i class="settings icon"></i> Account Settings</a>
                  </div>
                </div>
                <a class=" item">
                  <i class="heartbeat icon"></i> Favorites
                </a>        
                <a id="cart" class=" item">
                  <i class="shop icon"></i> Cart
                </a>                                     
            </nav>            
        </div>     
    </div>   
    
    <div class="ui attached stackable borderless huge menu">
        <div class="ui container">
            <h2 class="header item">
              <img src="images/logo5.png" class="ui small image" >
            </h2>  
            <a class="item" href="index.php">
              <i class="home icon"></i> Home 
            </a>       
            <a class="item" href="aboutus.php">
              <i class="mail icon"></i> About Us
            </a>      
            <a class="item">
              <i class="home icon"></i> Blog
            </a>      
            <div class="ui simple dropdown item">
              <i class="grid layout icon"></i>
              Browse
                <i class="dropdown icon"></i>
              <div class="menu">
                <a class="item" href="browse-artists.php"><i class="users icon"></i> Artists</a>
                <a class="item" href="browse-genres.php"><i class="theme icon"></i> Genres</a>
                <a class="item" href="browse-paintings.php"><i class="paint brush icon"></i> Paintings</a>
                <a class="item" href="browse-subjects.php"><i class="cube icon"></i> Subjects</a>
				<a class="item" href="browse-galleries.php"><i class="university icon"></i> Galleries</a>
              </div>
            </div>        
            <div class="right item">
                <div class="ui mini icon input">
                  <form action="browse-paintings.php" method="GET">
					<input type="text" placeholder="Search ..." name="search">
					<button type="submit" value="Search"> <i class="search icon"></i>
				  </form>
                </div>
            </div>      

        </div>
    </div>   
	
	<div id="cartModal" class="ui fullscreen modal">
	<h2 class="centered header">Shopping Cart</h2>
	<div class="ui grid container">
	<div class="fourteen wide column"></div>
		<div class="two wide column">	
		
		<div class="content">
		<table class="ui collapsing celled table">
			<thead>
        <tr>
            <th colspan="3">Charge</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <tr class="totals"><td colspan="3">Material</td><td colspan="2"></td></tr>
         <tr class="totals"><td colspan="3">Subtotal</td><td colspan="2"></td></tr>
		 <tr class="totals"><td colspan="3">Tax</td><td colspan="2"></td></tr>
		 <tr class="totals"><td colspan="3">Shipping</td><td colspan="2"></td></tr>
		 <tr class="totals"><td colspan="3">Material</td><td colspan="2"></td></tr>
		  <tr class="totals"><td colspan="3">Grand Total</td><td colspan="2"></td></tr>
		 
    </tbody>
		
		</table></div>
		
		</div>
		<div class="ui items">
		
		
		</div>
		
		
		</div>
	</div>
	
	</div>
	
	
    
</header> 