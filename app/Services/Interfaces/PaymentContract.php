<?php

namespace App\Services\Interfaces;

use App\Models\PaymentOrder;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;

interface PaymentContract
{
    /**
     * @return string
     */
    public function key(): string;

    /**
     * @return string
     */
    public function title(): string;

    /**
     * @return string
     */
    public function description(): string;


    /**
     * Wrapper for create payment order for charge money
     *
     * @param PaymentOrder $order
     * @param object       $inputData
     *
     * @return array
     * @throws ApiErrorException
     */
    public function charging(PaymentOrder $order, object $inputData): array;

    /**
     * @param Request $request
     *
     * @return array|string[]
     */
    public function validation(Request $request): array;

    /**
     * @param Request $request
     * @param mixed   $paymentIntentId
     *
     * @return array
     */
    public function refund(Request $request, mixed $paymentIntentId): array;
}
