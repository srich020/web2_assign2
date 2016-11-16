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
	public function deleteFavoritePainting($paintingId) { //Removes a painting from list.
        if (isset($this->favoritePaintings[$paintingId]) && !empty($this->favoritePaintings[$paintingId])) {
            unset($this->favoritePaintings[$paintingId]);
        }
        $this->saveFavoritePaintings();
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
                $quantity = $_GET['quantity'];
            } else {
                $quantity = (int) $this->cart[$id]['quantity'];
            }

            $item['quantity'] += $quantity;


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
			$total = ((int)$cartItem['Cost']*(int)$cartItem['quantity'])+$total;
		}
		return $total;
	}
	public function getMaterialCost(){
		return 0;
	}
	public function getSubtotal(){
		$subtotal = ($this->getTotalAmount()+$this->getMaterialCost());
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
		return $total;
	}
	public function getExpressShippingCosts(){
		$total = 0;
		foreach($this->cart as $cartItem){
			$total = ((int)$cartItem['quantity']*50)+$total;
		}
		return $total;
	}
	public function getTotal(){
		return $this->getTotalAmount()+$this->getTotalAmount()+$this->getTotalAmount()+$this->getTotalAmount()+$this->getTotalAmount()+$this->getTotalAmount()
	}
	
}

?>