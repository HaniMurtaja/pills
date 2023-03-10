<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\Admin\MedicineResource;
use App\Models\Medicine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicinesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicineResource(Medicine::with(['user_med', 'care_meds'])->get());
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->all());
        $medicine->care_meds()->sync($request->input('care_meds', []));

        return (new MedicineResource($medicine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicineResource($medicine->load(['user_med', 'care_meds']));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->all());
        $medicine->care_meds()->sync($request->input('care_meds', []));

        return (new MedicineResource($medicine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
