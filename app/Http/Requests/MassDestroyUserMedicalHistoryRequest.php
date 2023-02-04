<?php

namespace App\Http\Requests;

use App\Models\UserMedicalHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserMedicalHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user_medical_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:user_medical_histories,id',
        ];
    }
}
