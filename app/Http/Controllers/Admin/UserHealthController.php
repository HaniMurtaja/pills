<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserHealthRequest;
use App\Http\Requests\StoreUserHealthRequest;
use App\Http\Requests\UpdateUserHealthRequest;
use App\Models\User;
use App\Models\UserHealth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserHealthController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_health_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserHealth::with(['user'])->select(sprintf('%s.*', (new UserHealth())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_health_show';
                $editGate = 'user_health_edit';
                $deleteGate = 'user_health_delete';
                $crudRoutePart = 'user-healths';

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
            $table->editColumn('careby_id', function ($row) {
                return $row->careby_id ? $row->careby_id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? UserHealth::GENDER_SELECT[$row->gender] : '';
            });

            $table->editColumn('blood_pressure', function ($row) {
                return $row->blood_pressure ? $row->blood_pressure : '';
            });
            $table->editColumn('blood_group', function ($row) {
                return $row->blood_group ? $row->blood_group : '';
            });
            $table->editColumn('height', function ($row) {
                return $row->height ? $row->height : '';
            });
            $table->editColumn('weight', function ($row) {
                return $row->weight ? $row->weight : '';
            });
            $table->editColumn('bmi', function ($row) {
                return $row->bmi ? $row->bmi : '';
            });
            $table->editColumn('total_cholestrol', function ($row) {
                return $row->total_cholestrol ? $row->total_cholestrol : '';
            });
            $table->editColumn('ldl_cholestrol', function ($row) {
                return $row->ldl_cholestrol ? $row->ldl_cholestrol : '';
            });
            $table->editColumn('hdl_cholestrol', function ($row) {
                return $row->hdl_cholestrol ? $row->hdl_cholestrol : '';
            });
            $table->editColumn('triglycerides', function ($row) {
                return $row->triglycerides ? $row->triglycerides : '';
            });
            $table->editColumn('glucose', function ($row) {
                return $row->glucose ? $row->glucose : '';
            });
            $table->addColumn('user_user_id', function ($row) {
                return $row->user_id ? $row->user->user_id : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_id']);

            return $table->make(true);
        }

        return view('admin.userHealths.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_health_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userHealths.create', compact('users'));
    }

    public function store(StoreUserHealthRequest $request)
    {
        $userHealth = UserHealth::create($request->all());

        return redirect()->route('admin.user-healths.index');
    }

    public function edit(UserHealth $userHealth)
    {
        abort_if(Gate::denies('user_health_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('user_id', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userHealth->load('user_id');

        return view('admin.userHealths.edit', compact('userHealth', 'users'));
    }

    public function update(UpdateUserHealthRequest $request, UserHealth $userHealth)
    {
        $userHealth->update($request->all());

        return redirect()->route('admin.user-healths.index');
    }

    public function show(UserHealth $userHealth)
    {
        abort_if(Gate::denies('user_health_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHealth->load('user_id', 'careDocsUserDocs', 'carebiesUsers', 'careMedMedicines');

        return view('admin.userHealths.show', compact('userHealth'));
    }

    public function destroy(UserHealth $userHealth)
    {
        abort_if(Gate::denies('user_health_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userHealth->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserHealthRequest $request)
    {
        UserHealth::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
