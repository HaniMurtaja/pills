<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'service_price' => [
                'string',
                'nullable',
            ],
            'payment_method' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'arriving_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'user_orders.*' => [
                'integer',
            ],
            'user_orders' => [
                'array',
            ],
        ];
    }
}
