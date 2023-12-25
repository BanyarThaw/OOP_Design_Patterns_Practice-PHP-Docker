<?php
    class Pizza { // The Builder
        private $crust;
        private $sauce;
        private $toppings = [];
    
        public function setCrust($crust) {
            $this->crust = $crust;
        }
    
        public function setSauce($sauce) {
            $this->sauce = $sauce;
        }
    
        public function addTopping($topping) {
            $this->toppings[] = $topping;
        }
    
        public function describe() {
            $description = "Pizza with {$this->crust} crust, {$this->sauce} sauce, and toppings: ";
            $description .= implode(', ', $this->toppings);
            return $description;
        }
    }
    
    class PizzaBuilder { // Concrete builder
        private $pizza;
    
        public function __construct() {
            $this->pizza = new Pizza();
        }
    
        public function setCrust($crust) {
            $this->pizza->setCrust($crust);
        }
    
        public function setSauce($sauce) {
            $this->pizza->setSauce($sauce);
        }
    
        public function addTopping($topping) {
            $this->pizza->addTopping($topping);
        }
    
        public function build() {
            return $this->pizza;
        }
    }

    class PizzaDirector { // Director (only if necessary)
        private $builder;
    
        public function __construct(PizzaBuilder $builder) {
            $this->builder = $builder;
        }
    
        public function buildPizzaWithMushrooms() {
            $this->builder->setCrust('Thin');
            $this->builder->setSauce('Tomato');
            $this->builder->addTopping('Cheese');
            $this->builder->addTopping('Mushrooms');
        }

        public function build() {
            return $this->builder->build();
        }
    }

    // Client code
    $pizzaBuilder = new PizzaBuilder();
    $pizzaBuilder->setCrust('Thin');
    $pizzaBuilder->setSauce('Tomato');
    $pizzaBuilder->addTopping('Cheese');
    $pizzaBuilder->addTopping('Mushrooms');
    $pizza = $pizzaBuilder->build();
    echo $pizza->describe();

    echo "<br>"; // breaking new line

    // Client Code (Using Director)
    $pizzaBuilder = new PizzaBuilder();
    $pizzaDirector = new PizzaDirector($pizzaBuilder);
    $pizzaDirector->buildPizzaWithMushrooms();
    $pizza = $pizzaBuilder->build();
    echo $pizza->describe();
?>