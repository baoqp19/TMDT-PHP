<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => "required|min:2|max:20|string",
            'email' => "required|min:3|max:50|email:filter",
            'phone' => "required|digits:10",
            'node' => "min:2|min:2|max:100|string",
            'payment' => "required|min:0|integer",
        ];
    }
}
