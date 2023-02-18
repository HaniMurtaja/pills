<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function forgot() {
        
        $credentials = request()->validate(['email' => 'required|email|exists:users']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

}
