<?php

namespace App\Http\Requests;

use App\Models\Medicine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medicine_edit');
    }

    public function rules()
    {
        return [
            'med_generic_name' => [
                'string',
                'required',
            ],
            'med_scientific_name' => [
                'string',
                'required',
            ],
            'med_quantity' => [
                'string',
                'nullable',
            ],
            'med_expire_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'care_meds.*' => [
                'integer',
            ],
            'care_meds' => [
                'required',
                'array',
            ],
        ];
    }
}
