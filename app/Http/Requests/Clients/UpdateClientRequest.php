<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('clients')->ignore($this->route('id')),
            ],
            'phone' => 'required|celular_com_ddd',
            'email' => [
                'required',
                'email',
                Rule::unique('clients')->ignore($this->route('id'))
            ],
            'birth_date' => 'date',
        ];
    }
}
