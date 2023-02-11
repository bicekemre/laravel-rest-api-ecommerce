<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:20'],
            "slug" => "required|sometimes|unique:App\Models\Category,slug",
            'is_active' => ['required', 'sometimes', 'boolean'],
            'is_recommended' => ['required', 'boolean']
        ];
    }
}
