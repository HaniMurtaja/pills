<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMedicineRequest;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\Medicine;
use App\Models\User;
use App\Models\UserHealth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MedicinesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Medicine::with(['user_med', 'care_meds'])->select(sprintf('%s.*', (new Medicine())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'medicine_show';
                $editGate = 'medicine_edit';
                $deleteGate = 'medicine_delete';
                $crudRoutePart = 'medicines';

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
            $table->editColumn('med_generic_name', function ($row) {
                return $row->med_generic_name ? $row->med_generic_name : '';
            });
            $table->editColumn('med_scientific_name', function ($row) {
                return $row->med_scientific_name ? $row->med_scientific_name : '';
            });
            $table->editColumn('med_quantity', function ($row) {
                return $row->med_quantity ? $row->med_quantity : '';
            });

            $table->addColumn('user_med_user', function ($row) {
                return $row->user_med ? $row->user_med->user : '';
            });

            $table->editColumn('care_med', function ($row) {
                $labels = [];
                foreach ($row->care_meds as $care_med) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $care_med->careby);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user_med', 'care_med']);

            return $table->make(true);
        }

        return view('admin.medicines.index');
    }

    public function create()
    {
        abort_if(Gate::denies('medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_meds = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_meds = UserHealth::pluck('careby_id', 'id');

        return view('admin.medicines.create', compact('care_meds', 'user_meds'));
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->all());
        $medicine->care_meds()->sync($request->input('care_meds', []));

        return redirect()->route('admin.medicines.index');
    }

    public function edit(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_meds = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_meds = UserHealth::pluck('careby_id', 'id');

        $medicine->load('user_med', 'care_meds');

        return view('admin.medicines.edit', compact('care_meds', 'medicine', 'user_meds'));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->all());
        $medicine->care_meds()->sync($request->input('care_meds', []));

        return redirect()->route('admin.medicines.index');
    }

    public function show(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->load('user_med', 'care_meds');

        return view('admin.medicines.show', compact('medicine'));
    }

    public function destroy(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicineRequest $request)
    {
        Medicine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
