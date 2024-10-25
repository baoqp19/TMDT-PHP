<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeshipRequest extends FormRequest
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
            'city_code' => "required|min:0|integer",
            'province_code' => "required|min:0|integer",
            'village_code' => "required|min:0|integer",
            'feeship' => "required|min:1000|numeric",
        ];
    }
}
