<?php

namespace App\Http\Requests;

use App\Models\Orders;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('user', Orders::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'config_id' => 'required|exists:configs,id',
            'status' => 'required|in:pending,completed,cancelled',
            'total_price' => 'prohibited',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The specified user does not exist.',

            'config_id.required' => 'The configuration is required.',
            'config_id.exists' => 'The specified configuration does not exist.',

            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of: pending, completed, cancelled.',

            'total_price.prohibited' => 'The total price is calculated automatically and cannot be provided manually.',
        ];
    }
}
