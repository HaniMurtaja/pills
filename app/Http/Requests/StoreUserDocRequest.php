<?php

namespace App\Http\Requests;

use App\Models\UserDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserDocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_doc_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'description' => [
                'string',
                'required',
            ],
            'file' => [
                'required',
            ],
            'care_docs.*' => [
                'integer',
            ],
            'care_docs' => [
                'required',
                'array',
            ],
        ];
    }
}
