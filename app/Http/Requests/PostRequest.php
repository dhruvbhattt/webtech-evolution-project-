<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'property_name' => [
                'required'
            ],
            'no_of_guests' => [
                'required',
                'numeric',
            ],
            'available_date' => [
                'required',
                'date',
            ],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id'),
            ],
            'sub_category_id' => [
                'required',
                Rule::exists('sub_categories', 'id'),
            ],
        ];
    }
}
