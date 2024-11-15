<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ];
    }

    /**
     * Messages for validation
     */
    public function messages(): array
    {
        return [
            'name.required' => 'This name is required.',
            'name.min' => 'This name is too short.',
            'email.required' => 'This email is required.',
            'email.unique' => 'This email is already used'
        ];
    }
}
