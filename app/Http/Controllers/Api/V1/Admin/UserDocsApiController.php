<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserDocRequest;
use App\Http\Requests\UpdateUserDocRequest;
use App\Http\Resources\Admin\UserDocResource;
use App\Models\UserDoc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDocsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDocResource(UserDoc::with(['care_docs', 'user_doc'])->get());
    }

    public function store(StoreUserDocRequest $request)
    {
        $userDoc = UserDoc::create($request->all());
        $userDoc->care_docs()->sync($request->input('care_docs', []));
        if ($request->input('file', false)) {
            $userDoc->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new UserDocResource($userDoc))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserDoc $userDoc)
    {
        abort_if(Gate::denies('user_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDocResource($userDoc->load(['care_docs', 'user_doc']));
    }

    public function update(UpdateUserDocRequest $request, UserDoc $userDoc)
    {
        $userDoc->update($request->all());
        $userDoc->care_docs()->sync($request->input('care_docs', []));
        if ($request->input('file', false)) {
            if (!$userDoc->file || $request->input('file') !== $userDoc->file->file_name) {
                if ($userDoc->file) {
                    $userDoc->file->delete();
                }
                $userDoc->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($userDoc->file) {
            $userDoc->file->delete();
        }

        return (new UserDocResource($userDoc))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserDoc $userDoc)
    {
        abort_if(Gate::denies('user_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDoc->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
