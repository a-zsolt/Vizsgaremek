<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarModelsRequest extends FormRequest
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
        $id = $this->route('model');
        return [
            'name' => 'sometimes|required|string|unique:car_models,name,' . $id . '|max:255',
            'year' => 'sometimes|required|string|max:4',
            'description' => 'sometimes|required|string',
            'base_price' => 'sometimes|required|integer|min:0',
            'model_file' => 'sometimes|required|string',
        ];
    }
}
