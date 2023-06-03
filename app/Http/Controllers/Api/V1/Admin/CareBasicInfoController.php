<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CareBasicInfoStoreRequest;
use App\Http\Requests\UserBasicInfoStoreRequest;
use App\Http\Resources\Admin\CareResource;
use App\Http\Resources\Admin\ReminderResource;
use App\Http\Resources\Admin\UserInfoResource;
use App\Models\Reminder;
use App\Models\User;
use App\Models\UserBasicInfo;
use App\Models\UserHealth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CareBasicInfoController extends Controller
{
    public function care_basic_info($care_id)
    {
        try {

            $user_basic_info = User::find($care_id);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Get Successfully',
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


    public function getCaresUser()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id = Auth::user()->id;
        $cares = UserHealth::where('user_id',$user_id)->get();
        return CareResource::collection($cares);
    }

    public function care_basic_info_store(CareBasicInfoStoreRequest $request)
    {
        try {

            DB::beginTransaction();


            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['gender'] = $request->gender;
            $data['relation'] = $request->relation;
            $data['date_of_brith'] = $request->date_of_brith;
            $user_id = request()->user()->id;


            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File upload location
                $location = 'storage/users';

                // Upload file
                $path = $file->move($location, $filename);
                $data['image'] = $path;
            }

            $user_basic_info = User::create($data);

            $user_basic_info->userUserHealths()->create(['name' => $user_basic_info->name, 'user_id' => $user_id, 'careby_id' => $user_basic_info->id]);
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

    public function care_basic_info_update(CareBasicInfoStoreRequest $request, $care_id)
    {
        try {

            DB::beginTransaction();


            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['gender'] = $request->gender;
            $data['relation'] = $request->relation;
            $data['date_of_brith'] = $request->date_of_brith;
            $user_id = request()->user()->id;


            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File upload location
                $location = 'storage/users';

                // Upload file
                $path = $file->move($location, $filename);
                $data['image'] = $path;
            }

            $user_basic_info = User::find($care_id);
            $user_basic_info->update($data);

            $user_basic_info->userUserHealths()->create(['name' => $user_basic_info->name, 'user_id' => $user_id, 'careby_id' => $user_basic_info->id]);
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
