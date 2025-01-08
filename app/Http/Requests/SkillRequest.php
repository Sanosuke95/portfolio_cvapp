<?php

namespace App\Http\Requests;

class SkillRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function store(): array
    {
        return [
            'name' => 'required|min:3'
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
            'name' => 'min:2'
        ];
    }


    /**
     * All message for error
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages()
    {
        return [
            'name.required' => 'The name is required',
            'name.min' => 'This name is too short'
        ];
    }
}
