<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required',"max:50", Rule::unique('categories')],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category is required.',
            'name.unique' =>'This category is already in exist.',
        ];
    }
}
