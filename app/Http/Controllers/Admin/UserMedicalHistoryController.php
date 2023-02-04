<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserMedicalHistoryRequest;
use App\Http\Requests\StoreUserMedicalHistoryRequest;
use App\Http\Requests\UpdateUserMedicalHistoryRequest;
use App\Models\User;
use App\Models\UserHealth;
use App\Models\UserMedicalHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserMedicalHistoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_medical_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserMedicalHistory::with(['user_history', 'care_histories'])->select(sprintf('%s.*', (new UserMedicalHistory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_medical_history_show';
                $editGate = 'user_medical_history_edit';
                $deleteGate = 'user_medical_history_delete';
                $crudRoutePart = 'user-medical-histories';

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
            $table->editColumn('disease_name', function ($row) {
                return $row->disease_name ? $row->disease_name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('user_history_user_id', function ($row) {
                return $row->user_history ? $row->user_history->user_id : '';
            });

            $table->editColumn('care_history', function ($row) {
                $labels = [];
                foreach ($row->care_histories as $care_history) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $care_history->careby);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user_history', 'care_history']);

            return $table->make(true);
        }

        return view('admin.userMedicalHistories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_medical_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_histories = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_histories = UserHealth::pluck('careby_id', 'id');

        return view('admin.userMedicalHistories.create', compact('care_histories', 'user_histories'));
    }

    public function store(StoreUserMedicalHistoryRequest $request)
    {
        $userMedicalHistory = UserMedicalHistory::create($request->all());
        $userMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return redirect()->route('admin.user-medical-histories.index');
    }

    public function edit(UserMedicalHistory $userMedicalHistory)
    {
        abort_if(Gate::denies('user_medical_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_histories = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_histories = UserHealth::pluck('careby_id', 'id');

        $userMedicalHistory->load('user_history', 'care_histories');

        return view('admin.userMedicalHistories.edit', compact('care_histories', 'userMedicalHistory', 'user_histories'));
    }

    public function update(UpdateUserMedicalHistoryRequest $request, UserMedicalHistory $userMedicalHistory)
    {
        $userMedicalHistory->update($request->all());
        $userMedicalHistory->care_histories()->sync($request->input('care_histories', []));

        return redirect()->route('admin.user-medical-histories.index');
    }

    public function show(UserMedicalHistory $userMedicalHistory)
    {
        abort_if(Gate::denies('user_medical_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMedicalHistory->load('user_history', 'care_histories');

        return view('admin.userMedicalHistories.show', compact('userMedicalHistory'));
    }

    public function destroy(UserMedicalHistory $userMedicalHistory)
    {
        abort_if(Gate::denies('user_medical_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userMedicalHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserMedicalHistoryRequest $request)
    {
        UserMedicalHistory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
