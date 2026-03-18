<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigsRequest extends FormRequest
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
            'user_id' => 'sometimes|required|exists:users,id',
            'car_model_id' => 'sometimes|required|exists:car_models,id',
            'color_option_id' => 'sometimes|required|exists:color__options,id',
            'wheel_option_id' => 'sometimes|required|exists:wheel__options,id',
            'interior_option_id' => 'sometimes|required|exists:interior__options,id',
            'accessory_id' => 'sometimes|required|exists:accessories,id',
            'total_price' => 'sometimes|required|integer|min:0',
        ];
    }
}
