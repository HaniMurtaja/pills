<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMedicalGuideRequest;
use App\Http\Requests\UpdateMedicalGuideRequest;
use App\Http\Resources\Admin\MedicalGuideResource;
use App\Models\MedicalGuide;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicalGuidesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medical_guide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicalGuideResource(MedicalGuide::all());
    }

    public function store(StoreMedicalGuideRequest $request)
    {
        $medicalGuide = MedicalGuide::create($request->all());

        if ($request->input('guide_image', false)) {
            $medicalGuide->addMedia(storage_path('tmp/uploads/' . basename($request->input('guide_image'))))->toMediaCollection('guide_image');
        }

        return (new MedicalGuideResource($medicalGuide))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MedicalGuide $medicalGuide)
    {
        abort_if(Gate::denies('medical_guide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicalGuideResource($medicalGuide);
    }

    public function update(UpdateMedicalGuideRequest $request, MedicalGuide $medicalGuide)
    {
        $medicalGuide->update($request->all());

        if ($request->input('guide_image', false)) {
            if (!$medicalGuide->guide_image || $request->input('guide_image') !== $medicalGuide->guide_image->file_name) {
                if ($medicalGuide->guide_image) {
                    $medicalGuide->guide_image->delete();
                }
                $medicalGuide->addMedia(storage_path('tmp/uploads/' . basename($request->input('guide_image'))))->toMediaCollection('guide_image');
            }
        } elseif ($medicalGuide->guide_image) {
            $medicalGuide->guide_image->delete();
        }

        return (new MedicalGuideResource($medicalGuide))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MedicalGuide $medicalGuide)
    {
        abort_if(Gate::denies('medical_guide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicalGuide->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
