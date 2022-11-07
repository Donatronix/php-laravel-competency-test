<?php

namespace App\Services;

use RuntimeException;

class PaymentServiceManager
{
    public static function getInstance(string $paymentMethod)
    {
        $class = 'App\Services\\' . $paymentMethod . 'Service';
        if (class_exists($class)) {
            return new $class();
        }
        throw new RuntimeException('Payment method not found');
    }
}
