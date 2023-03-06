<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBasicInfoStoreRequest;
use App\Http\Resources\Admin\UserInfoResource;
use App\Models\User;
use App\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBasicInfoController extends Controller
{

    public function user_basic_info_store(UserBasicInfoStoreRequest $request)
    {
        try {

            DB::beginTransaction();

            $data['image'] = $request->image;
            $data['name'] = $request->full_name;
            $data['phone'] = $request->phone;
            $data['dob'] = $request->date_of_birth;

            $user_basic_info = User::create($data);

            if ($request->input('image', false)) {
                $user_basic_info->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }


            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Created Successfully',
                'data' => new UserInfoResource($user_basic_info),
            ], 200);


        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
