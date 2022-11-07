<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class PaymentMethodValidator.
 *
 * @package namespace App\Validators;
 */
class PaymentMethodValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required', 'string', 'unique:payment_methods,name'],
            'description' => ['required', 'string'],
            'charge' => ['required', 'numeric'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required', 'string', 'unique:payment_methods,name,{id}'],
            'description' => ['required', 'string'],
            'charge' => ['required', 'numeric'],
        ],
    ];
}
