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


            $data['name'] = $request->full_name;
            $data['phone'] = $request->phone;
            $data['dob'] = $request->date_of_birth;




            if($request->file('image')){
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();

                // File upload location
                $location = 'users';

                // Upload file
                $path =  $file->move($location,$filename);
                $data['image'] = $path;
            }
            $user_basic_info = User::create($data);
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
