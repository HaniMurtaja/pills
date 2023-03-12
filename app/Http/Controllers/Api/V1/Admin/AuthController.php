<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {


        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'nullable',
                    'google_id' => 'nullable'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'google_id' => $request->google_id,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => date('Y-m-d h:i:s'),
                'email_verified_at'        => date('Y-m-d h:i:s'),
                'password' => Hash::make($request->password)
            ]);
            $user->roles()->attach(2);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'data' => new UserResource($user),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function login(Request $request)
{

    try {

        if (isset($request->google_id)){


            $user = User::where('google_id', $request->google_id)->first();

            if(!User::where('google_id',$request->google_id)->first()){
                return response()->json([
                    'status' => false,
                    'message' => 'google_id does not match with our record.',
                ], 401);
            }
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data' => new UserResource($user),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        }else {

            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data' => new UserResource($user),
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        }


    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

public  function logout(){

    // Get user who requested the logout
    $user = request()->user(); //or Auth::user()

// Revoke current user token
    $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

    return response()->json([
        'status' => true,
        'message' => 'User Logout In Successfully',
    ], 200);
}


}

