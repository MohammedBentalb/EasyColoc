<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2'],
        ];
    }
    public function messages(): array {
        return [
            'name.required' => 'Name Is Required',
            'name.string' => 'Wrong Name Format',
            'name.min' => 'Minimum Characters Has Not Been Reached',
        ];
    }
}
