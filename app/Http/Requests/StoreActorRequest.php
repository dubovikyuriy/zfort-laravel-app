<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:actors,email',
            'description' => 'required|unique:actors,description',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email already exist',
            'description.required' => 'Description required',
            'description.unique' => 'Description already exist',
        ];
    }
}
