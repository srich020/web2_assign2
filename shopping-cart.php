
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
    }elseif($_GET['action'] == 'delete' && !empty($_GET['id'])){
		$cart->deleteShoppingItem($_GET['id']);
		
		
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
			if(count($_SESSION['shoppingCart']) == 1){
				echo "There are no items in your cart!";
			}
            
            
              foreach($cart->getCart() as $cartItem){
                printSingleCartRow($cartItem);
              } 

            function printSingleCartRow($row = array()) {
                echo '<div class="item">
	<div class="image">
	<img href="single-painting.php?id='.$row["PaintingID"].'" src="images/art/works/square-medium/'.$row["ImageFileName"].'.jpg">
		</div>
		<div class="content">
			 <div class="ui segment">
                                        <div class="ui form">
										<form action="shopping-cart.php" method="get">
                                            <div class="ui tiny statistic">
					<a class="header" href="single-painting.php?id='.$row["PaintingID"].'">'.utf8_encode($row["Title"]).'</a>
                        </div>
                        <div class="four fields">
                            <div class="two wide field">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value="'.$row['quantity'].'">
                            </div><div class="three wide field"><label>Individual Cost</label>$'.number_format($row['Cost']).'
									</div><div class="three wide field"><label>Material</label>$
                            </div><div class="three wide field"><label>Total Cost</label>$'.($row['Cost']*$row['quantity']).'
                            </div>                                                </div>                     
                                            </form></div>
			<div>
 





                                                
                                        </div>

								<a href="shopping-cart.php?action=delete&id='.$row["PaintingID"].'"><button class="ui grey icon button"><i class="trash icon"></i></button></a>
			</div>
		</div>
	</div>

	<div class="ui divider"></div>';
            }
			
			//BUFFER
			//<div class="description">Individual Cost: $'.number_format($row["Cost"]).'<br>Total Cost: $'.($row['Cost']*$row['quantity']).'</div>
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
                    <tr class="totals"><td colspan="3">Base Costs</td><td colspan="2">$<?php echo $cart->getTotalAmount();?></td></tr>
					<tr class="totals"><td colspan="3">Material</td><td colspan="2">$<?php echo $cart->getMaterialCost();?></td></tr>
                    <tr class="totals"><td colspan="3">Subtotal</td><td colspan="2">$<?php echo $cart->getSubtotal();?></td></tr>
                    <tr class="totals"><td colspan="3">Tax</td><td colspan="2">$<?php echo $cart->getTax();?></td></tr>
                    <tr class="totals"><td colspan="3">Standard Shipping</td><td colspan="2">$<?php echo $cart->getStandardShippingCosts();?></td></tr>
					<tr class="totals"><td colspan="3">Express Shipping</td><td colspan="2">$<?php echo $cart->getExpressShippingCosts();?></td></tr>
                    <tr class="totals"><td colspan="3">Total</td><td colspan="2">$<?php echo $cart->getExpressShippingCosts();?></td></tr>
                </tbody>
            </table></div>

    </div>
</div></body></html>

