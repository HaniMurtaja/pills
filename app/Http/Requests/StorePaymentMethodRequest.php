<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentMethodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_method_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
            'card_number' => [
                'string',
                'required',
                'unique:payment_methods',
            ],
            'expired_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
