<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name|max:255',
            'description' => 'required|max:500',
            'category_id' => 'required|numeric|exists:categories,id',
            'amount' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0.01',
        ];
    }
}
