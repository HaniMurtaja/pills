<?php

namespace App\Http\Requests;

use App\Models\MedicalGuide;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMedicalGuideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('medical_guide_create');
    }

    public function rules()
    {
        return [
            'guide_name' => [
                'string',
                'required',
            ],
            'guide_category' => [
                'string',
                'required',
            ],
            'guide_phone' => [
                'string',
                'required',
            ],
            'guide_image' => [
                'nullable',
            ],
            'guide_working_hours' => [
                'string',
                'required',
            ],
            'guide_status' => [
                'required',
            ],
            'guide_address' => [
                'string',
                'required',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
        ];
    }
}
