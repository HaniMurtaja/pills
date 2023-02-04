<?php

namespace App\Http\Requests;

use App\Models\MedicalGuide;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMedicalGuideRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('medical_guide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:medical_guides,id',
        ];
    }
}
