
<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art", "sadsquad", "sadsquad");
$pdo = DBHelper::createConnection($i);
$paintingdata = new PaintingDB($pdo);
$artistdata = new ArtistDB($pdo);
$cart = new ShoppingCart();


//Functionality for adding a cart item
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == 'add' && !empty($_GET['id'])) {
        $paintingId = $_GET['id'];

        // get product details
        $itemData = $paintingdata->findByID($paintingId)->fetch();
        $artist = $artistdata -> findByID($itemData["ArtistID"])->fetch();
        //was there a quantity entered?
        if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
            $itemData['quantity'] = $_GET['quantity'];
        } else {
            $itemData['quantity'] = 1;
        }


        $cart->addToCart($itemData);
    }
}
?>

<div class="ui grid container">
    <div class="ui hidden divider"></div>
    <h1 class='ui header'>Shopping Cart</h1>
    <div class="fourteen wide column">
        <div class="ui hidden divider"></div>
        <div class="ui items">
            <?php
            
            
              foreach($cart->getCart() as $cartItem){
                printSingleCartRow($cartItem);
              } 

            function printSingleCartRow($cartItem = array()) {
                $row = '<div class="item">
                                <div class="image">
                                <img class="ui medium image" src="images/art/works/square-medium/'.$cartItem["ImageFileName"].'.jpg">
                                </div>
                                <div class="content">
                                        <a class="header" href="single-painting.php?id='.$cartItem["PaintingID"].'">'.$cartItem["Title"].'</a>
                                        
                                        <div class="description">$'.number_format($cartItem["Cost"]).'</div>
                                </div>
                        </div>';
                echo $row;
            }
            ?>

        </div>

        </nav>            
    </div> 
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
</div></body></html>

