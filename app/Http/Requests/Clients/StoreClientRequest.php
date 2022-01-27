<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'cpf' => 'required|cpf|unique:clients',
            'phone' => 'required|celular_com_ddd',
            'email' => 'required|email|unique:clients',
            'birth_date' => 'date',
        ];
    }
}
