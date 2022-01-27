<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'company_name' => 'required|max:255',
            'trade_name' => 'required|max:255',
            'cnpj' => 'required|cnpj|unique:suppliers',
            'phone' => 'required|celular_com_ddd',
            'email' => 'required|email|unique:suppliers|max:255',
        ];
    }
}
