<?php

namespace App\Http\Requests;

use App\Models\UserHealth;
//use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UpdateUserHealthRequest extends FormRequest
{
  //  public function authorize()
  //  {
 //       return Gate::allows('user_health_edit');
 //   }

    public function rules()
    {
        return [
            'careby' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                Rule::unique('user_healths')->ignore($this->user()->id, 'careby_id'),

            ],
            'name' => [
                'string',
                'required',
            ],
        //    'gender' => [
          //      'required',
          //  ],
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'blood_pressure' => [
                'string',
                'required',
            ],
            'blood_group' => [
                'string',
                'required',
            ],
            'height' => [
                'numeric',
                'required',
            ],
            'weight' => [
                'numeric',
                'required',
            ],
            'bmi' => [
                'numeric',
                'required',
            ],
            'total_cholestrol' => [
                'string',
                'required',
            ],
            'ldl_cholestrol' => [
                'string',
                'required',
            ],
            'hdl_cholestrol' => [
                'string',
                'required',
            ],
            'triglycerides' => [
                'string',
                'required',
            ],
            'glucose' => [
                'string',
                'required',
            ],
        ];
    }
}
