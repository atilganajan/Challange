<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'image' => [
                Rule::when($this->old_image == 0, 'required|image|mimes:jpeg,png|max:3072'),
            ],
            'name' => 'required|max:50',
            'category' => 'required',
            'description' => 'required|max:255',
        ];
    }

    public function messages()
    {
        {
            return [
                'image.max' => 'The image field must not be greater than 3 MB.',
            ];
        }
    }
}
