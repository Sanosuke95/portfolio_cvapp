<?php

namespace App\Http\Requests;

class FormationRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function store(): array
    {
        return [
            'name' => "required|min:3",
            'location' => "required",
            'start_date' => "required",
            'end_date' => "required",
            'description' => "required|min:10"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function update(): array
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
