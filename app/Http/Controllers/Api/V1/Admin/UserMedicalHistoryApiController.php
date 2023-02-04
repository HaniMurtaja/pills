<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserMedicalHistoryRequest;
use App\Http\Requests\UpdateUserMedicalHistoryRequest;
use App\Http\Resources\Admin\UserMedicalHistoryResource;
use App\Models\UserMedicalHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMedicalHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_medical_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserMedicalHistoryResource(UserMedicalHistory::with(['user_history', 'care_histories'])->get());
    }

    public function store(StoreUserMedicalHistoryRequest $request)
    {
        $userMedicalHistory = UserMedicalHistory::create($request->all());
        $userMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return (new UserMedicalHistoryResource($userMedicalHistory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserMedicalHistory $userMedicalHistory)
    {
        abort_if(Gate::denies('user_medical_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserMedicalHistoryResource($userMedicalHistory->load(['user_history', 'care_histories']));
    }

    public function update(UpdateUserMedicalHistoryRequest $request, UserMedicalHistory $userMedicalHistory)
    {
        $userMedicalHistory->update($request->all());
        $userMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return (new UserMedicalHistoryResource($userMedicalHistory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserMedicalHistory $userMedicalHistory)
    {
        abort_if(Gate::denies('user_medical_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMedicalHistory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
