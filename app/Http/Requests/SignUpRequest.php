<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
    public function messages()
    {
        return [
            'email.unique' => 'Địa chỉ email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:20',
            'email' => "required|email:rfc,dns|unique:users,email",
            'phone' => "required|digits:10|unique:users,phone",
            'password' => 'required|string|confirmed|min:8|max:100',
            'password_confirmation' => 'required|string|min:8|max:100',
        ];
    }
}
