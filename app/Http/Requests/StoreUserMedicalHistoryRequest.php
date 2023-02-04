<?php

namespace App\Http\Requests;

use App\Models\UserMedicalHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserMedicalHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_medical_history_create');
    }

    public function rules()
    {
        return [
            'disease_name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'care_histories.*' => [
                'integer',
            ],
            'care_histories' => [
                'required',
                'array',
            ],
        ];
    }
}
