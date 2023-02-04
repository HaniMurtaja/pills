<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserDocRequest;
use App\Http\Requests\StoreUserDocRequest;
use App\Http\Requests\UpdateUserDocRequest;
use App\Models\User;
use App\Models\UserDoc;
use App\Models\UserHealth;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserDocsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserDoc::with(['care_docs', 'user_doc'])->select(sprintf('%s.*', (new UserDoc())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_doc_show';
                $editGate = 'user_doc_edit';
                $deleteGate = 'user_doc_delete';
                $crudRoutePart = 'user-docs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('care_docs', function ($row) {
                $labels = [];
                foreach ($row->care_docs as $care_doc) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $care_doc->careby);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('user_doc_user_id', function ($row) {
                return $row->user_doc ? $row->user_doc->user_id : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'file', 'care_docs', 'user_doc']);

            return $table->make(true);
        }

        return view('admin.userDocs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_doc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $care_docs = UserHealth::pluck('careby_id', 'id');

        $user_docs = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userDocs.create', compact('care_docs', 'user_docs'));
    }

    public function store(StoreUserDocRequest $request)
    {
        $userDoc = UserDoc::create($request->all());
        $userDoc->care_docs()->sync($request->input('care_docs', []));
        if ($request->input('file', false)) {
            $userDoc->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userDoc->id]);
        }

        return redirect()->route('admin.user-docs.index');
    }

    public function edit(UserDoc $userDoc)
    {
        abort_if(Gate::denies('user_doc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $care_docs = UserHealth::pluck('careby_id', 'id');

        $user_docs = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userDoc->load('care_docs', 'user_doc');

        return view('admin.userDocs.edit', compact('care_docs', 'userDoc', 'user_docs'));
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

        return redirect()->route('admin.user-docs.index');
    }

    public function show(UserDoc $userDoc)
    {
        abort_if(Gate::denies('user_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDoc->load('care_docs', 'user_doc');

        return view('admin.userDocs.show', compact('userDoc'));
    }

    public function destroy(UserDoc $userDoc)
    {
        abort_if(Gate::denies('user_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDoc->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserDocRequest $request)
    {
        UserDoc::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_doc_create') && Gate::denies('user_doc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserDoc();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
