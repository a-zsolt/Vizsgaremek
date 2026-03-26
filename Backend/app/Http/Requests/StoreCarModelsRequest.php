<?php

namespace App\Http\Requests;

use App\Models\CarModels;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarModelsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('manager', CarModels::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:car_models,name|max:255',
            'year' => 'required|string|max:4',
            'description' => 'required|string',
            'base_price' => 'required|integer|min:0',
            'model_file' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The car model name is required.',
            'name.string' => 'The car model name must be a text string.',
            'name.unique' => 'The car model name has already been taken.',
            'name.max' => 'The car model name may not be greater than :max characters.',

            'year.required' => 'The model year is required.',
            'year.string' => 'The model year must be a text string.',
            'year.max' => 'The model year may not be greater than :max characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a text string.',

            'base_price.required' => 'The base price is required.',
            'base_price.integer' => 'The base price must be an integer.',
            'base_price.min' => 'The base price must be at least :min.',

            'model_file.required' => 'The model file is required.',
            'model_file.string' => 'The model file must be a text string.',
        ];
    }
}
