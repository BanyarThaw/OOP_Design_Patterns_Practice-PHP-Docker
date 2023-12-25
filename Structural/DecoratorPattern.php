<?php
    interface Beverage { // The Component
        public function getDescription(): string;
        public function getCost(): float;
    }
    
    class Coffee implements Beverage { // Concrete Component
        public function getDescription(): string {
            return "Coffee";
        }
    
        public function getCost(): float {
            return 2.5;
        }
    }
    
    abstract class BeverageDecorator implements Beverage { // Base Decorator
        protected $beverage;
    
        public function __construct(Beverage $beverage) {
            $this->beverage = $beverage;
        }
    
        public function getDescription(): string {
            return $this->beverage->getDescription();
        }
    
        public function getCost(): float {
            return $this->beverage->getCost();
        }
    }
    
    class MilkDecorator extends BeverageDecorator { // Concrete Decorator
        public function getDescription(): string {
            return $this->beverage->getDescription() . ", Milk";
        }
    
        public function getCost(): float {
            return $this->beverage->getCost() + 0.5;
        }
    }
    
    class CaramelDecorator extends BeverageDecorator { // Concrete Decorator
        public function getDescription(): string {
            return $this->beverage->getDescription() . ", Caramel";
        }
    
        public function getCost(): float {
            return $this->beverage->getCost() + 0.75;
        }
    }
    
    // Client code
    $coffee = new Coffee(); // product
    $coffeeWithMilk = new MilkDecorator($coffee);
    $coffeeWithMilkAndCaramel = new CaramelDecorator($coffeeWithMilk);
    
    echo $coffeeWithMilkAndCaramel->getDescription(); // Output: "Coffee, Milk, Caramel"
    echo $coffeeWithMilkAndCaramel->getCost(); // Output: 3.75
?>