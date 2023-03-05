<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBasicInfoStoreRequest;
use App\Http\Resources\Admin\UserInfoResource;
use App\Models\UserBasicInfo;
use Illuminate\Http\Request;

class UserBasicInfoController extends Controller
{

    public function user_basic_info_store(UserBasicInfoStoreRequest $request)
    {
        try {


            $data['image'] = $request->image;
            $data['full_name'] = $request->full_name;
            $data['country_code'] = $request->country_code;
            $data['phone'] = $request->phone;
            $data['date_of_birth'] = $request->date_of_birth;




            if($request->file('image')){
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();

                // File upload location
                $location = "assets/user_info";

                // Upload file
                $path =  $file->move($location,$filename);
                $data['image'] = $path;
            }

            $user_basic_info = UserBasicInfo::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Created Successfully',
                'data' => new UserInfoResource($user_basic_info),
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
