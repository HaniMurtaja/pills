<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBasicInfoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'full_name'=>'required',
            'phone'=>'required',
            'date_of_birth'=>'required|date',
            'image'=>'nullable|image|max:1024',
        ];
    }
}