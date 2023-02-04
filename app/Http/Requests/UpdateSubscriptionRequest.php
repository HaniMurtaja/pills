<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscription_edit');
    }

    public function rules()
    {
        return [
            'user' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:subscriptions,user,' . request()->route('subscription')->id,
            ],
            'payment_method' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'subsription_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
