<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColocationRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2'],
            'address' => ['required', 'string', 'min:2'],
            'city' => ['required', 'string', 'min:2'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10048'],
        ];
    }
    public function messages(): array {
        return [
            'name.required' => 'Name Is Required',
            'name.string' => 'Wrong Name Format',
            'name.min' => 'Minunum Characters Has Not Been Reached',
            'address.required' => 'Address Is Required',
            'address.string' => 'Wrong Address Format',
            'address.min' => 'Minunum Characters Has Not Been Reached',
            'city.required' => 'City Is Required',
            'city.string' => 'Wrong City Format',
            'city.min' => 'Minunum Characters Has Not Been Reached',
            'image.max' => 'Max Size  Has Not Been Reached',
        ];
    }
}
