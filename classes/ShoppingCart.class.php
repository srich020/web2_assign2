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


            $quantity;
            //Is it already in the cart?
            if (!isset($this->cart[$id])) {
                $this->cart[$id] = $item;
                $quantity = 0;
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

    protected function saveAndUpdateCart() {

        foreach ($this->cart as $key => $cartItem) {
            $this->cart['total'] += ($cartItem['Cost'] * $cartItem['quantity']);
        }

        $_SESSION['shoppingCart'] = $this->cart;
    }

//put your code here
}

?>