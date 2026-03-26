<?php

namespace App\Http\Requests\auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginAuthRequest extends FormRequest
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
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address is required.',
            'email.string' => 'The email address must be a text string.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email address may not be greater than :max characters.',

            'password.required' => 'The password is required.',
            'password.string' => 'The password must be a text string.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
