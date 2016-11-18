<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art", "sadsquad", "sadsquad");
$pdo = DBHelper::createConnection($i);
$paintingdata = new PaintingDB($pdo);
$artistdata = new ArtistDB($pdo);
$favorites = new FavoritesList();

if (isset($_GET['action']) && !empty($_GET['action'])) {   // CHECK FOR ACTIONS
    if ($_GET['action'] == 'add' && !empty($_GET['id'])) { // 'ADD' ACTIONS
        $paintingId = $_GET['id'];
         $singlePainting = $paintingdata->findByID($paintingId)->fetch();
        $singleArtist = $artistdata->findByID($singlePainting["ArtistID"])->fetch();

        if (isset($_GET['type'])) {
            if ($_GET['type'] == 'painting') {   
                $favorites->addToFavoritePaintings($singlePainting);
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            } else if ($_GET['type'] == 'artist') {     
                $singleArtist=$artistdata->findByID($_GET['id'])->fetch();
                $favorites->addToFavoriteArtists($singleArtist);
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            }
        }
    }                                                         //'DELETE' ACTIONS
    if ($_GET['action'] == 'delete' && !empty($_GET['id'])) { //---Delete particular id----
        $id = $_GET['id'];
        if (isset($_GET['type'])) {
            if ($_GET['type'] == 'painting') {
                $favorites->deleteFavoritePainting($id);     //Delete 1 painting from list
                
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            } else if ($_GET['type'] == 'artist') {
                $favorites->deleteFavoriteArtist($id);       //Delete 1 artist from list
                
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            }
        }
    } else if ($_GET['action'] == 'delete' && empty($_GET['id'])) {                       //----No specified ID---
        if (isset($_GET['type'])) {
            if ($_GET['type'] == 'painting') {             //Deletes all paintings from list
                $favorites->clearAllPaintings();
                
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            } else if ($_GET['type'] == 'artist') {
                $favorites->clearAllArtists();             //Deletes all artists from list
                
                header("Location: http://localhost/assign2_SADSquad/favorites-list.php");
            }
        }
    }
}
?>
<div class="ui hidden divider"></div>
<div class="ui container grid">
    <div class="five wide column"></div>
    <div class="eight wide column">
        <div class='ui header'><h1>FAVORITES</h1></div>
    </div>
    <div class="three wide column"></div>
    
        
</div>

<div class="ui divider"></div>
<div class="ui container grid">
    <div class='two wide column'></div>
    <div class="six wide column">
        <h2 class="ui header">Artists</h2>&nbsp;<a href='favorites-list.php?action=delete&type=artist'>Clear List</a>
        <div class="ui hidden divider"></div> 
        <div class="ui divided items">

            <?php
            foreach ($favorites->getFavoriteArtists() as $artist) {
                outputSingleArtistRow($artist);
            }

            function outputSingleArtistRow($singleArtist) {
                $id = $singleArtist['ArtistID'];
                
                $row = '<div class="item">
                     <div class="ui tiny image">
                     <a href="single-artist.php?id='.$id.'">
                 <img class="tiny image" src="images/art/artists/square-thumb/' . $id . '.jpg"></a>
                    
                    </div>
                <div class="middle aligned content">
                 <a href="favorites-list.php?action=delete&type=artist&id='.$id.'">
                         <button class="ui grey icon button"><i class="trash icon"></i></button></a> 
                 
                  <a href="single-artist.php?id='.$id.'">'. utf8_encode($singleArtist['FirstName']) . ' ' . utf8_encode($singleArtist['LastName']) . '</a>
                </div>
              </div>';
                echo $row;
          
            }
            ?>





        </div></div>
    <div class="six wide column grid">
        <h2 class="ui header">Paintings</h2>&nbsp;<a href='favorites-list.php?action=delete&type=painting'>Clear List</a>
        <div class="ui hidden divider"></div> 
        <div class="ui divided items">


            <?php
           
            foreach ($favorites->getFavoritePaintings() as $painting) {
                $singleArtist = $artistdata->findByID($painting['ArtistID'])->fetch();
                outputSinglePaintingRow($painting, $singleArtist);
            }
            
            function outputSinglePaintingRow($singlePainting = array(), $singleArtist = array()) {
                $get = $singlePainting['PaintingID'];
                
                
                $thingy = '<div class="item">
                    <div class="ui tiny image">
                       <a href="single-painting.php?id='.$get.'">'
                        . '<img class="small image" src="images/art/works/square-small/'.$singlePainting['ImageFileName'] . '.jpg"></a>
                    </div>
                    
                    <div class="middle aligned content">
                    <a href="favorites-list.php?action=delete&type=painting&id='.$get.'">
                         <button class="ui grey icon button"><i class="trash icon"></i></button></a> 
                      <a class="header" href="single-painting.php?id=' . $get .
                        '">'.utf8_encode(  $singlePainting['Title']) .'</a>
                              
                    </div>
                  </div>';

                
                echo $thingy;
            }
            ?>


        </div>





    </div>
    
</div>
<?php include "./inc/footer.inc.php"; ?>
