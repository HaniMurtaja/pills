<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;
use App\Http\Resources\Admin\ReminderResource;
use App\Models\Reminder;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RemindersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource(Reminder::with(['user_reminder', 'care_reminders'])->get());
    }


    public function getUserReminders()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id = Auth::user()->id;
        $reminders = Reminder::where('user_reminder_id',$user_id)->with(['user_reminder', 'care_reminders'])->get();
        return new ReminderResource($reminders);
    }

    public function store(StoreReminderRequest $request)
    {
        $user_id = Auth::user()->id;

        $data['doses']  =$request->doses;
        $data['times']  =$request->times;
        $data['duration']  =$request->duration;
        $data['days_of_week']  =$request->days_of_week;
        $data['start_from']  =$request->start_from;
        $data['snooze']  =$request->snooze;
        $data['date']  =$request->date;
        $data['care_reminders']  =$request->care_reminders;
        $data['time']  =$request->time;
        $data['user_reminder_id']  =$user_id;
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

    public function update(UpdateReminderRequest $request, $id)
    {

        $reminder = Reminder::find($id);
        if (!$reminder)
            return response()->json(['data'=>'Data Not Found'],404);
        $reminder->update($request->all());
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
