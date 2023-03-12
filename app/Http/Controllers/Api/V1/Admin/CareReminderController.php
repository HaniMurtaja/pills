<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareReminderRequest;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Resources\Admin\ReminderResource;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CareReminderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource(Reminder::with(['user_reminder', 'care_reminders'])->get());
    }

    public function store(StoreCareReminderRequest $request)
    {


        $reminder = Reminder::create($request->all());
        $reminder->care_reminders()->sync($request->input('care_reminders', []));

        return (new ReminderResource($reminder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
