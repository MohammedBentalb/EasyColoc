<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepenseCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'amount' => ['required', 'numeric', 'min:1'],
            'category_id' => ['required', Rule::exists('categories','id')],
            'user_id' => ['required', Rule::exists('users', 'id')],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title Is Required',
            'title.string' => 'Wrong Title Format',
            'title.min' => 'Minimum Characters Has Not Been Reached',
            'amount.required' => 'Amount Is Required',
            'amount.numeric' => 'Wrong Amount Format',
            'amount.min' => 'Minimum Amount Has Not Been Reached',
            'category_id.required' => 'Category Is Required',
            'category_id.exists' => 'Wrong Category Insertion',
            'user_id.required' => 'User Is Required',
            'user_id.exists' => 'Wrong User Insertion',
        ];
    }
}
