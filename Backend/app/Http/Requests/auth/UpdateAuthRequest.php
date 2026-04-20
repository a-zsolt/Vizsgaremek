<?php

namespace App\Http\Requests\auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = $this->user();
        // The user being updated (resolved from the {user} route parameter)
        $targetUser = $this->route('user');

        // Allow if the user is an admin OR if they are updating their own profile
        return $authenticatedUser->tokenCan('admin') || $authenticatedUser->id === $targetUser->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($this->route('user')->id),
            ],
            'role' => $this->user()->tokenCan('admin') ? 'sometimes|in:user,admin,manager' : 'prohibited',
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $this->user()->id,
            'password' => 'sometimes|required|string|min:8'
        ];
    }

    public function messages()
    {
        return [
            'role.prohibited' => 'You do not have permission to change user roles.',

            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a text string.',
            'name.max' => 'The name may not be greater than :max characters.',

            'role.in' => 'The role must be one of: user, admin, manager.',

            'email.required' => 'The email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email address may not be greater than :max characters.',
            'email.unique' => 'The email address has already been taken.',

            'password.required' => 'The password is required.',
            'password.string' => 'The password must be a text string.',
            'password.min' => 'The password must be at least :min characters.',
        ];
    }
}
