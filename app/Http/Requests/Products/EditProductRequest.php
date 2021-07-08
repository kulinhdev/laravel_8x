<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class EditProductRequest extends FormRequest
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
     * @return array
     */
    public function rules($id)
    {
        return [
            'name' => ['required', 'min:6', Rule::unique('products')->ignore($id)],
            'image' => 'mimes:jpg,jpeg,png',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ];
    }
}
