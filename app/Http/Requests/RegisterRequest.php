<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "username" => ['required', 'string', 'min:3'],
            "password" => ['required', 'string', 'min:8'],
            "image" => ['nullable', 'image', 'max:10000'],
        ];
    }
     
    public function messages(): array {
        return [
            "email.required" => 'Email Is Required',
            "email.email" => 'Wrong Email Format',
            "email.unique" => 'Email Is Already Taken',
            "password.required" => 'Password Is Required',
            "password.string" => 'Wrong Password Format',
            "password.min" => 'Minimum Characters Unreached',
            "username.required" => 'username Is Required',
            "username.string" => 'Wrong Username Format',
            "username.min" => 'Minimum Characters Unreached',
            "image.image" => 'Wrong Image Format',
            "image.size" => 'max Size Have Benn Reached',
        ];
    }
}
