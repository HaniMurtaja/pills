<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMedicalGuideRequest;
use App\Http\Requests\StoreMedicalGuideRequest;
use App\Http\Requests\UpdateMedicalGuideRequest;
use App\Models\MedicalGuide;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MedicalGuidesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('medical_guide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MedicalGuide::query()->select(sprintf('%s.*', (new MedicalGuide())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'medical_guide_show';
                $editGate = 'medical_guide_edit';
                $deleteGate = 'medical_guide_delete';
                $crudRoutePart = 'medical-guides';

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
            $table->editColumn('guide_name', function ($row) {
                return $row->guide_name ? $row->guide_name : '';
            });
            $table->editColumn('guide_category', function ($row) {
                return $row->guide_category ? $row->guide_category : '';
            });
            $table->editColumn('guide_phone', function ($row) {
                return $row->guide_phone ? $row->guide_phone : '';
            });
            $table->editColumn('guide_image', function ($row) {
                if ($photo = $row->guide_image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('guide_working_hours', function ($row) {
                return $row->guide_working_hours ? $row->guide_working_hours : '';
            });
            $table->editColumn('guide_status', function ($row) {
                return $row->guide_status ? MedicalGuide::GUIDE_STATUS_SELECT[$row->guide_status] : '';
            });
            $table->editColumn('guide_address', function ($row) {
                return $row->guide_address ? $row->guide_address : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'guide_image']);

            return $table->make(true);
        }

        return view('admin.medicalGuides.index');
    }

    public function create()
    {
        abort_if(Gate::denies('medical_guide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicalGuides.create');
    }

    public function store(StoreMedicalGuideRequest $request)
    {
        $medicalGuide = MedicalGuide::create($request->all());

        if ($request->input('guide_image', false)) {
            $medicalGuide->addMedia(storage_path('tmp/uploads/' . basename($request->input('guide_image'))))->toMediaCollection('guide_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medicalGuide->id]);
        }

        return redirect()->route('admin.medical-guides.index');
    }

    public function edit(MedicalGuide $medicalGuide)
    {
        abort_if(Gate::denies('medical_guide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicalGuides.edit', compact('medicalGuide'));
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

        return redirect()->route('admin.medical-guides.index');
    }

    public function show(MedicalGuide $medicalGuide)
    {
        abort_if(Gate::denies('medical_guide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.medicalGuides.show', compact('medicalGuide'));
    }

    public function destroy(MedicalGuide $medicalGuide)
    {
        abort_if(Gate::denies('medical_guide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicalGuide->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicalGuideRequest $request)
    {
        MedicalGuide::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('medical_guide_create') && Gate::denies('medical_guide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MedicalGuide();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
