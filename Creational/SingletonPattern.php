<?php

class ShoppingCartManager
{
    private static $instance;
    private $cartItems = [];

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    public function addToCart($product, $quantity)
    {
        if (isset($this->cartItems[$product])) {
            $this->cartItems[$product] += $quantity;
        } else {
            $this->cartItems[$product] = $quantity;
        }
    }

    public function removeFromCart($product)
    {
        if (isset($this->cartItems[$product])) {
            unset($this->cartItems[$product]);
        }
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function displayCart()
    {
        echo "Shopping Cart:\n";
        foreach ($this->cartItems as $product => $quantity) {
            echo "- $product: $quantity\n";
        }
    }
}

$cartManager = ShoppingCartManager::getInstance();

// Add products to the cart
$cartManager->addToCart('Product A', 2);
$cartManager->addToCart('Product B', 1);

// Remove a product from the cart
$cartManager->removeFromCart('Product A');

// Display the cart items
$cartManager->displayCart();