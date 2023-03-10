<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'user' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:users,user',
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'address' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
//            'carebies' => [
//                'integer',
//            ],
//            'carebies' => [
//                'array',
//            ],
        ];
    }
}
