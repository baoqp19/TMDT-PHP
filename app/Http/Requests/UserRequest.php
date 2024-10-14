<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:20',
            'phone' => "required|digits:10",
            'status' => 'nullable|string|min:2|max:50',
            'address' => 'nullable|string|min:2|max:50',
            'image' => 'mimes:jpg,jpeg,png,gif|max:20000',
        ];
    }
}
