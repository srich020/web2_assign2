
<?php
include './inc/header.inc.php';
include './classes/AutoLoader.php';
$i = Array("mysql:host=localhost;dbname=art", "sadsquad", "sadsquad");
$pdo = DBHelper::createConnection($i);
$paintingdata = new PaintingDB($pdo);
$artistdata = new ArtistDB($pdo);
$cart = new ShoppingCart();


//Add extra buttons
//replace buttons in BrowsePaintings and SinglePaintings 
//Functionality for adding a cart item

if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == 'add' && !empty($_GET['id'])) {

        $paintingId = $_GET['id'];

        // get product details
        $itemData = $paintingdata->findByID($paintingId)->fetch();
        $artist = $artistdata->findByID($itemData["ArtistID"])->fetch();
        //was there a quantity entered?
        if (isset($_GET['quantity']) && !empty($_GET['quantity'])) {
            $itemData['quantity'] = $_GET['quantity'];
        }
        $itemData['frame'] = isset($_GET['Frame']) ? $_GET['Frame'] : 'none';
        $itemData['glass'] = isset($_GET['Glass']) ? $_GET['Glass'] : 'none';
        $itemData['matt'] = isset($_GET['Matt']) ? $_GET['Matt'] : 'none';
        $cart->addToCart($itemData);
        header("Location: http://localhost/assign2_SADSquad/shopping-cart.php");
    } elseif ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        $cart->deleteShoppingItem($_GET['id']);
        header("Location: http://localhost/assign2_SADSquad/shopping-cart.php");
    } elseif ($_GET['action'] == 'update' && !empty($_GET['id']) && isset($_GET['quantity'])) {
        $cart->updateQuantity($_GET['quantity'], $_GET['id']);
        header("Location: http://localhost/assign2_SADSquad/shopping-cart.php");
    } elseif ($_GET['action'] == 'clearall') {
        $cart->deleteCart();
        header("Location: http://localhost/assign2_SADSquad/shopping-cart.php");
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
            if (count($_SESSION['shoppingCart']) == 1) {
                echo "There are no items in your cart!";
            }


            foreach ($cart->getCart() as $cartItem) {
                printSingleCartRow($cartItem, $cart);
            }

            function printSingleCartRow($row = array(), $cart) {
                echo '<div class="item">
	<div class="image">
	<img href="single-painting.php?id=' . $row["PaintingID"] . '" src="images/art/works/square-medium/' . $row["ImageFileName"] . '.jpg">
		</div>
		<div class="content">
			 <div class="ui segment">
                                        <div class="ui form">
                                            <div class="ui tiny statistic">
					<a class="header" href="single-painting.php?id=' . $row["PaintingID"] . '">' . utf8_encode($row["Title"]) . '</a>
                        </div>
                        <div class="five fields">
                            <div class="two wide field">
                                <label>Quantity</label>
								<form action="shopping-cart.php" id="update" method="get">
								<input type="hidden" name="id" value="' . $row['PaintingID'] . '">
								<input type="hidden" name="action" value="update">
                                <input type="number" name="quantity" value="' . $row['quantity'] . '">
							
                            </div><div class="three wide field"><label>Individual Cost</label>$' . number_format($row['Cost']) . '
									</div>
									<div class="three wide field"><label>Materials Chosen</label>' . $cart->getOptions($row) . '
									</div>
									<div class="three wide field"><label>Material</label>$' . $cart->getMaterialCost($row) . '
                            </div>
							<div class="three wide field"><label>Total Cost</label>$' . ($cart->getIndividualTotalCost($row)) . '
                            </div>                                                </div>                     
</div>
			<div>      
                                        </div>
				<button type="submit" class="ui blue icon button" value="Submit">Update Cart</button>
				</form>
				<a href="shopping-cart.php?action=delete&id=' . $row["PaintingID"] . '"><button class="ui grey icon button"><i class="trash icon"></i></button></a>
				<a href="single-painting.php?id=' . $row["PaintingID"] . '"><button class="ui orange icon button"><i class="write icon"></i></button></a></div>
		</div>
	</div>
	<div class="ui hidden divider"></div>';
            }
            ?>

        </div>

        </nav>            
    </div> 	
    <h4 class="ui horizontal divider header">
        <i class="bar chart icon"></i>
        Order Details</h4>


    <a href="#"> <button class="ui labeled icon red link button"> <i class="add to cart icon"></i> Checkout </button></a>
    <a href="index.php"><button class="ui labeled icon green button"><i class="play icon"></i>Continue Shopping</button></a>
    <a href="shopping-cart.php?action=clearall"><button class="ui labeled icon grey button"><i class="trash icon"></i>Clear Shopping Cart</button></a>
    <a href="shopping-cart.php?action=standard"><button class="ui labeled icon orange button"><i class="send icon"></i>Standard Shipping</button></a>
    <a href="shopping-cart.php?action=express"><button class="ui labeled icon orange button"><i class="send icon"></i>Express Shipping</button></a>



    <table class="ui definition table">
        <tbody>
            <tr>
                <td class="two wide column">Item Costs</td>
                <td>$<?php echo $cart->getTotalAmount(); ?></td>
            </tr>
            <tr>
                <td>Material</td>
                <td>$<?php echo $cart->getTotalMaterialCost(); ?></td>
            </tr>
            <tr>
                <td>Subtotal</td>
                <td>$<?php echo $cart->getSubtotal(); ?></td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>$<?php echo $cart->getTax(); ?></td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>$<?php echo $cart->getShippingCosts(); ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td>$<?php echo $cart->getTotal(); ?></td>
            </tr>
        </tbody>
    </table>

</div></body>


<?php include "./inc/footer.inc.php"; ?>

</html>



