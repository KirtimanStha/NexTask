<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required|string|max:49',
            'price' => 'required'
        ];
    }

    public function messages(): array
    {
        $messages = [
            'title.required' => 'Title is required',
            'title.max' => 'Max character of title must be 49!',
            'price.required' => 'Price is required'
        ];
        return $messages;
    }
}
