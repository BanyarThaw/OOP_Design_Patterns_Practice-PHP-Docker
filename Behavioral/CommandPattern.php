<?php

// Command interface
interface OrderCommand {
    public function execute();
}

// Concrete Command: Place Order
class PlaceOrderCommand implements OrderCommand {
    private $order;

    public function __construct($order) {
        $this->order = $order;
    }

    public function execute() {
        // Logic to place the order
        echo "Order placed successfully for {$this->order}.\n";
    }
}

// Concrete Command: Update Inventory
class UpdateInventoryCommand implements OrderCommand {
    private $product;
    private $quantity;

    public function __construct($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function execute() {
        // Logic to update inventory
        echo "Inventory updated for {$this->product} by {$this->quantity} units.\n";
    }
}

// Concrete Command: Generate Invoice
class GenerateInvoiceCommand implements OrderCommand {
    private $order;

    public function __construct($order) {
        $this->order = $order;
    }

    public function execute() {
        // Logic to generate invoice
        echo "Invoice generated for Order #{$this->order}.\n";
    }
}

// Invoker
class OrderProcessor {
    private $commands = [];

    public function addCommand(OrderCommand $command) {
        $this->commands[] = $command;
    }

    public function processOrders() {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}

// Client code
$orderProcessor = new OrderProcessor();

// Client places an order
$orderProcessor->addCommand(new PlaceOrderCommand(123));

// Update inventory for the ordered items
$orderProcessor->addCommand(new UpdateInventoryCommand('Product A', 5));
$orderProcessor->addCommand(new UpdateInventoryCommand('Product B', 3));

// Generate invoice for the order
$orderProcessor->addCommand(new GenerateInvoiceCommand(123));

// Process all commands
$orderProcessor->processOrders();