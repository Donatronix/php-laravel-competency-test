<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'password' => ['required'],
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => ['required', 'string', 'max:150'],
        ],
    ];
}
