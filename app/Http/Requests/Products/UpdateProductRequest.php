<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'sku' => [
                'required',
                'max:255',
                Rule::unique('products')->ignore($this->route('product_id'))
            ],
            'price' => 'required|numeric',
            'stock' => 'required|numeric',

        ];
    }
}
