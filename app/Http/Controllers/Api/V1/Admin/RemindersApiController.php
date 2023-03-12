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

        $reminder = Reminder::create($request->all());
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
