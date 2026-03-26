<?php

namespace App\Http\Requests;

use App\Http\Controllers\api\ConfigController;
use App\Models\Configs;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('user', Configs::class);
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
    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required when provided.',
            'user_id.exists' => 'The specified user does not exist.',

            'car_model_id.required' => 'The car model is required when provided.',
            'car_model_id.exists' => 'The specified car model does not exist.',

            'color_option_id.required' => 'The color option is required when provided.',
            'color_option_id.exists' => 'The specified color option does not exist.',

            'wheel_option_id.required' => 'The wheel option is required when provided.',
            'wheel_option_id.exists' => 'The specified wheel option does not exist.',

            'interior_option_id.required' => 'The interior option is required when provided.',
            'interior_option_id.exists' => 'The specified interior option does not exist.',

            'accessory_id.required' => 'The accessory is required when provided.',
            'accessory_id.exists' => 'The specified accessory does not exist.',

            'total_price.required' => 'The total price is required when provided.',
            'total_price.integer' => 'The total price must be an integer.',
            'total_price.min' => 'The total price must be at least :min.',
        ];
    }
}
