<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
    public function rules(): array {
        return [
            "email" => ['required', 'email', Rule::exists('users', 'email')],
            "password" => ['required', 'string', 'min:8'],
        ];
    }
     
    public function messages(): array {
        return [
            "email.required" => 'Email Is Required',
            "email.email" => 'Wrong Email Format',
            "email.exists" => 'Invalid Credentials',
            "password.required" => 'Password Is Required',
            "password.string" => 'Wrong Password Format',
            "password.min" => 'Minimum Characters Unreached',
        ];
    }
}
