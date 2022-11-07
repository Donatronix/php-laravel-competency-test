<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'sender_id' => ['required', 'numeric', 'exists:users,id'],
            'amount' => ['required', 'numeric'],
            'order_id' => ['required', 'numeric'],
            'receiver_id' => ['required'],
        ];
    }
}
