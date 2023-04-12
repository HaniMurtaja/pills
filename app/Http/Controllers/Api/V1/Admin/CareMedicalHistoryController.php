<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareMedicalHistoryRequest;
use App\Http\Requests\StoreUserMedicalHistoryRequest;
use App\Http\Requests\UpdateCareMedicalHistoryRequest;
use App\Http\Requests\UpdateUserMedicalHistoryRequest;
use App\Http\Resources\Admin\UserMedicalHistoryResource;
use App\Models\UserMedicalHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CareMedicalHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_medical_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserMedicalHistoryResource(UserMedicalHistory::with(['user_history', 'care_histories'])->get());
    }

    public function store(StoreCareMedicalHistoryRequest $request)
    {

        $careMedicalHistory = UserMedicalHistory::create($request->all());
        $careMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return (new UserMedicalHistoryResource($careMedicalHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateCareMedicalHistoryRequest $request,$id)
    {

        $careMedicalHistory = UserMedicalHistory::find($id);
        if ($careMedicalHistory)
            $careMedicalHistory->update($request->all());
            $careMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return (new UserMedicalHistoryResource($careMedicalHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }


}
