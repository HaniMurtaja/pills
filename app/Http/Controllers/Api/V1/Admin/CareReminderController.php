<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareReminderRequest;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Resources\Admin\ReminderResource;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CareReminderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource(Reminder::with(['user_reminder', 'care_reminders'])->get());
    }


    public function get_all_care_reminder()
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReminderResource(Reminder::with(['care_reminders'])->get());
    }

    public function searchCareReminders(Request $request){

        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $search_date = $request->search_date ;
        $reminders = Reminder::whereDate('created_at', $search_date)->with(['care_reminders'])->get();
        return new ReminderResource($reminders);
    }
    
    public function getCareReminders($id)
    {
        abort_if(Gate::denies('reminder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $care_reminder_id = $id ;
        $reminders = Reminder::where('care_reminder_id',$care_reminder_id)->with(['care_reminders'])->get();
        return new ReminderResource($reminders);
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
