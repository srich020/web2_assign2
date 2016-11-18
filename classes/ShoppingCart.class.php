<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShoppingCart
 *
 * @author david han
 */
class ShoppingCart {
    protected $cart = array();

    public function __construct() {

        if (isset($_SESSION['shoppingCart']) && !empty($_SESSION['shoppingCart'])) {
            $this->cart = $_SESSION['shoppingCart'];
        } else {
            $this->cart = array('total' => 0);
            $this->saveAndUpdateCart();
        }
    }

    public function getCart() {
        unset($this->cart['total']); //Extra record in list, needs unhooking
        return $this->cart;
    }

    public function getCartTotal() {
        return $this->cart['total'];
    }

    public function addToCart($item = array()) {
        if (!is_array($item) OR count($item) === 0) { //Empty cart?
            return FALSE;
        } else {
            $id = $item["PaintingID"];
            if (!isset($this->cart[$id])) {
                $this->cart[$id] = $item;
            }else{
				$this->cart[$id]['quantity'] = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
				$this->cart[$id]['frame'] = isset($_GET['Frame']) ? $_GET['Frame'] : 'none';
				$this->cart[$id]['glass'] = isset($_GET['Glass']) ? $_GET['Glass'] : 'none';
				$this->cart[$id]['matt'] = isset($_GET['Matt']) ? $_GET['Matt'] : 'none';
			}
            // save cart
            if ($this->saveAndUpdateCart()) {
                return isset($rowid) ? $rowid : TRUE;
            } else {
                return FALSE;
            }
        }
    }
	public function deleteShoppingItem($paintingId) { //Removes an artist from list.
        if (isset($this->cart[$paintingId]) && !empty($this->cart[$paintingId])) {
            unset($this->cart[$paintingId]);
        }
        $this->saveAndUpdateCart();
    }
	public function deleteCart(){
		    $this->cart = array('total' => 0);
            $this->saveAndUpdateCart();
	}
	public function updateQuantity($number,$id){
		$this->cart[$id]['quantity'] = $number;
		$this->saveAndUpdateCart();
	}

    protected function saveAndUpdateCart() {

        foreach ($this->cart as $key => $cartItem) {
            $this->cart['total'] += ($cartItem['Cost'] * $cartItem['quantity']);
        }

        $_SESSION['shoppingCart'] = $this->cart;
    }

//put your code here

//cart logic 

	public function getTotalAmount(){
		$total = 0;
		foreach($this->cart as $cartItem){
			$total = ((int)$cartItem['Cost']*(int)$cartItem['quantity'])+$total+$this->getMaterialCost($cartItem);
		}
		return $total;
	}
	public function getIndividualTotalCost($cartItem){
		$total = ((int)$cartItem['Cost']*(int)$cartItem['quantity'])+$this->getMaterialCost($cartItem);
		return $total;
	}
	public function getMaterialCost($itemData){
		$i = Array("mysql:host=localhost;dbname=art", "sadsquad", "sadsquad");
		$pdo = DBHelper::createConnection($i);
		$amount = 0;
		if($itemData['matt'] == "none" || $itemData['matt'] == "[None]"){
			
		}else{
			$amount += ($itemData['quantity']*10);
		}
		
		if($itemData['frame'] == "none" || $itemData['frame'] == "[None]"){
			
		}else{
			$Frames = new FrameDB($pdo);
			$framesamount = $Frames->findByID($itemData['frame'])->fetch();
			$amount += ($framesamount['Price']*$itemData['quantity']);
		}
		
		if($itemData['glass'] == "none" || $itemData['glass'] == "[None]"){
		}else{
			$Glass = new GlassDB($pdo);
			$glasssamount = $Glass->findByID($itemData['glass'])->fetch();
			$amount += ($glasssamount['Price']*$itemData['quantity']);
		}
		return $amount;
	}
	public function getTotalMaterialCost(){
		$total = 0;
		foreach($this->cart as $cartItem){
		$total += $this->getMaterialCost($cartItem);
		}
		return $total;
	}
	public function getSubtotal(){
		$subtotal = ($this->getTotalAmount());
		return $subtotal;
	}
	public function getTax(){
		return $this->getSubtotal()*0.05;
	}
	public function getStandardShippingCosts(){
		$total = 0;
		foreach($this->cart as $cartItem){
			$total = ((int)$cartItem['quantity']*25)+$total;
		}
		if($total < 1500){
		return $total;
		}else{
			return 0;
		}
	}
	public function getExpressShippingCosts(){
		$total = 0;
		foreach($this->cart as $cartItem){
			$total = ((int)$cartItem['quantity']*50)+$total;
		}
		if($total < 2500){
		return $total;
		}else{
			return 0;
		}
	}
	public function getTotal(){
		return ($this->getTotalAmount()+$this->getTotalMaterialCost()+$this->getTax()+$this->getStandardShippingCosts());
	}
	
	public function getOptions($row){
		$return = "";
		if($row['glass'] == "[None]"){
			$return .= "Glass: none<br>";
		}else{
			$return .= 'Glass: '.$row['glass'].'<br>';
		}
		if($row['matt'] == "[None]"){
			$return .= "Matt: none<br>";
		}else{
			$return .= 'Matt: '.$row['matt'].'<br>';
		}
		if($row['frame'] == "[None]"){
			$return .= "Frame: none<br>";
		}else{
			$return .= 'Frame: '.$row['frame'].'<br>';
		}
		return $return;
	}
}

?>