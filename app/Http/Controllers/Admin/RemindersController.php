<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReminderRequest;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Models\Reminder;
use App\Models\User;
use App\Models\UserHealth;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RemindersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Reminder::with(['user_reminder', 'care_reminders'])->select(sprintf('%s.*', (new Reminder())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reminder_show';
                $editGate = 'reminder_edit';
                $deleteGate = 'reminder_delete';
                $crudRoutePart = 'reminders';

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
            $table->editColumn('doses', function ($row) {
                return $row->doses ? $row->doses : '';
            });
            $table->editColumn('duration', function ($row) {
                return $row->duration ? $row->duration : '';
            });
            $table->editColumn('times', function ($row) {
                return $row->times ? $row->times : '';
            });
            $table->editColumn('start_from', function ($row) {
                return $row->start_from ? $row->start_from : '';
            });
            $table->editColumn('days_of_week', function ($row) {
                return $row->days_of_week ? $row->days_of_week : '';
            });
            $table->editColumn('snooze', function ($row) {
                return $row->snooze ? $row->snooze : '';
            });

            $table->addColumn('user_reminder_user', function ($row) {
                return $row->user_reminder ? $row->user_reminder->user : '';
            });

            $table->editColumn('care_reminder', function ($row) {
                $labels = [];
                foreach ($row->care_reminders as $care_reminder) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $care_reminder->careby);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user_reminder', 'care_reminder']);

            return $table->make(true);
        }

        return view('admin.reminders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('reminder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_reminders = User::pluck('user', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_reminders = UserHealth::pluck('careby', 'id');

        return view('admin.reminders.create', compact('care_reminders', 'user_reminders'));
    }

    public function store(StoreReminderRequest $request)
    {
        $reminder = Reminder::create($request->all());
        $reminder->care_reminders()->sync($request->input('care_reminders', []));

        return redirect()->route('admin.reminders.index');
    }

    public function edit(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_reminders = User::pluck('user', 'id')->prepend(trans('global.pleaseSelect'), '');

        $care_reminders = UserHealth::pluck('careby', 'id');

        $reminder->load('user_reminder', 'care_reminders');

        return view('admin.reminders.edit', compact('care_reminders', 'reminder', 'user_reminders'));
    }

    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        $reminder->update($request->all());
        $reminder->care_reminders()->sync($request->input('care_reminders', []));

        return redirect()->route('admin.reminders.index');
    }

    public function show(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reminder->load('user_reminder', 'care_reminders');

        return view('admin.reminders.show', compact('reminder'));
    }

    public function destroy(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reminder->delete();

        return back();
    }

    public function massDestroy(MassDestroyReminderRequest $request)
    {
        Reminder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
