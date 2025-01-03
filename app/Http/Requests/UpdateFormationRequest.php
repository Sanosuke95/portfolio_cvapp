<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormationRequest extends FormRequest
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
            'name' => "min:3",
            'location' => "nullable",
            'start_date' => "nullable",
            'end_date' => "nullable",
            'description' => "min:10"
        ];
    }

    /**
     * All message for error
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name is required',
            'name.min' => 'The name is too short',
            'start_date.required' => 'The date is required',
            'end_date.required' => 'The date is required',
            'description.required' => 'The description is required',
            'description.min' => 'The description is too short'
        ];
    }
}