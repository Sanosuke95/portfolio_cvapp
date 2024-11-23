<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'email' => 'email|required',
            'subject' => 'required|min:4',
            'content' => 'min:4'
        ];
    }

    /**
     * All message for error
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'This email is required',
            'subject.required' => 'The subject is required',
            'subject.min' => 'The subject is too short',
            'content.min' => 'The content is too short'
        ];
    }
}
