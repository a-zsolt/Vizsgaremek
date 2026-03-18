<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreConfigsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'car_model_id' => 'required|exists:car_models,id',
            'color_option_id' => 'required|exists:color__options,id',
            'wheel_option_id' => 'required|exists:wheel__options,id',
            'interior_option_id' => 'required|exists:interior__options,id',
            'accessory_id' => 'required|exists:accessories,id',
            'total_price' => 'required|integer|min:0',
        ];
    }
}
