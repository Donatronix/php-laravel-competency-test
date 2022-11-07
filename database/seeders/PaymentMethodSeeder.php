<?php

namespace Database\Seeders;

use App\Services\Interfaces\PaymentMethodServiceInterface;
use Illuminate\Database\Seeder;
use Throwable;

class PaymentMethodSeeder extends Seeder
{
    private PaymentMethodServiceInterface $paymentMethodService;

    public function __construct(PaymentMethodServiceInterface $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    /**
     * @throws Throwable
     */
    public function run(): void
    {
        $this->paymentMethodService->store([
            'name' => 'PayPal',
            'description' => 'PayPal payment method',
            'charge' => 0.05,
        ]);

        $this->paymentMethodService->store([
            'name' => 'Credit Card',
            'description' => 'Credit Card payment method',
            'charge' => 0.05,
        ]);

        $this->paymentMethodService->store([
            'name' => 'Bank Transfer',
            'description' => 'Bank Transfer payment method',
            'charge' => 0.05,
        ]);
    }
}
