<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserBasicInfoStoreRequest;
use App\Http\Resources\Admin\UserInfoResource;
use App\Models\User;
use App\Models\UserBasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBasicInfoController extends Controller
{

    public function user_basic_info_store(UserBasicInfoStoreRequest $request)
    {
        try {

            DB::beginTransaction();


            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['date_of_birth'] = $request->date_of_birth;




            if($request->file('image')){
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();

                // File upload location
                $location = 'storage/users';

                // Upload file
                $path =  $file->move($location,$filename);
                $data['image'] = $path;
            }
            $user_id = Auth::user()->id ;
            $user_basic_info = User::find($user_id);
            $user_basic_info->update($data) ;
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Updated Successfully',
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