<?php

// Prototype interface
interface ProductPrototype {
    public function cloneProduct();
}

// Concrete Product class
class Product implements ProductPrototype {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    // Implementation of the clone method
    public function cloneProduct() {
        return new Product($this->name, $this->price);
    }
}

// Client code
$productPrototype = new Product("Sample Product", 19.99);

// Clone the prototype to create a new product
$newProduct = $productPrototype->cloneProduct();

// Output details of the new product
echo "Original Product: {$productPrototype->getName()} - {$productPrototype->getPrice()}";
echo "\nNew Product: {$newProduct->getName()} - {$newProduct->getPrice()}";
