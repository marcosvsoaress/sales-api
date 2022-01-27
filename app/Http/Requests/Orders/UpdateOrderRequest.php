<?php

namespace App\Http\Requests\Orders;

use App\Dominios\Orders\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
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
            'status' => [
                'required',
                'max:255',
                Rule::in([OrderStatusEnum::AWAITING_PAYMENT, OrderStatusEnum::PAYMENT_ACCEPT, OrderStatusEnum::CONCLUDED]),
            ]
        ];
    }
}
