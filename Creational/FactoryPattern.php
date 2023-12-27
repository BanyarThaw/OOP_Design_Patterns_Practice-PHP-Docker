<?php
    interface PaymentGateway {
        public function processPayment($amount);
    }

    class PayPalGateway implements PaymentGateway {
        public function processPayment($amount) {
            // Process payment using PayPal API
            echo "Payment processed with PayPal. Amount is $amount.";
        }
    }
    
    class StripeGateway implements PaymentGateway {
        public function processPayment($amount) {
            // Process payment using Stripe API
            echo "Payment processed with Stripe. Amount is $amount.";
        }
    }
    class PaymentGatewayFactory {
        public static function createPaymentGateway($type) {
            switch ($type) {
                case 'paypal':
                    return new PayPalGateway();
                case 'stripe':
                    return new StripeGateway();
                default:
                    throw new Exception('Invalid payment gateway type.');
            }
        }
    }
    $paymentGateway = PaymentGatewayFactory::createPaymentGateway('paypal');
    $paymentGateway->processPayment(100);
?>