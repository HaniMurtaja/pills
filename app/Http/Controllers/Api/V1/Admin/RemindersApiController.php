<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Http\Resources\Admin\ReminderResource;
use App\Models\Reminder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemindersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource(Reminder::with(['user_reminder', 'care_reminders'])->get());
    }

    public function store(StoreReminderRequest $request)
    {
        $data['doses'] = $request->doses;
        $data['times'] = $request->times;
        $data['applying'] =1;
        $data['time'] = 1;
        $data['duration'] = $request->duration;
        $data['days_of_week'] = $request->days_of_week;
        $data['start_from'] = $request->start_from;
        $data['snooze'] = $request->snooze;
        $data['date'] = $request->date;
        $data['user_reminder_id'] = $request->user_reminder_id;
        $data['care_reminders'] = $request->care_reminders;

        $reminder = Reminder::create($data);
       
        $reminder->care_reminders()->sync($request->input('care_reminders', []));

        return (new ReminderResource($reminder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }



    public function show(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource($reminder->load(['user_reminder', 'care_reminders']));
    }

    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        $data['doses'] = $request->doses;
        $data['times'] = $request->times;
        $data['applying'] =1;
        $data['time'] = 1;
        $data['duration'] = $request->duration;
        $data['days_of_week'] = $request->days_of_week;
        $data['start_from'] = $request->start_from;
        $data['snooze'] = $request->snooze;
        $data['date'] = $request->date;
        $data['user_reminder_id'] = $request->user_reminder_id;
        $data['care_reminders'] = $request->care_reminders;
        $reminder->update($data);
       
        $reminder->care_reminders()->sync($request->input('care_reminders', []));

        return (new ReminderResource($reminder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reminder $reminder)
    {
        abort_if(Gate::denies('reminder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reminder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
