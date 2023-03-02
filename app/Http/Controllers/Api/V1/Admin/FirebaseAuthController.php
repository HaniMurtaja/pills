<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\RevokedIdToken;
use App\Services\Firebase\FirebaseToken;

class FirebaseAuthController extends Controller
{
    public function store(Request $request)
    {
        $token = new FirebaseToken($request->bearerToken());

        try {
            $payload = $token->verify(config('services.firebase.project_id'));
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'User Registration Failed!'
            ], 500);
        }

        $user = User::create([
            'firebase_id' => $payload->user_id,
            'email' => $payload->email,
            'name' => $payload->name,
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
