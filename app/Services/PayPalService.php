<?php

namespace App\Services;

use App\Models\PaymentOrder;
use Illuminate\Http\Request;

class PayPalService implements Interfaces\PaymentContract
{

    /**
     * @inheritDoc
     */
    public function key(): string
    {
        return 'paypal';
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'PayPal payment service provider';
    }

    /**
     * @inheritDoc
     */
    public function description(): string
    {
        return 'PayPal Payment Processing Platform for the Internet';
    }

    /**
     * @inheritDoc
     */
    public function charging(PaymentOrder $order, object $inputData): array
    {
        // TODO: Implement charging() method.
    }

    /**
     * @inheritDoc
     */
    public function validation(Request $request): array
    {
        // TODO: Implement validation() method.
    }

    /**
     * @inheritDoc
     */
    public function refund(Request $request, mixed $paymentIntentId): array
    {
        // TODO: Implement refund() method.
    }
}
