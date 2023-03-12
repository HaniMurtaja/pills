<?php

namespace App\Http\Requests;

use App\Models\Reminder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCareReminderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reminder_create');
    }

    public function rules()
    {
        return [
            'care_reminder_id' => [
                'required',
                'integer',
                'exists:users,id',

            ],
            'doses' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'time' => [
                'string',
                'required',
            ],
            'times' => [
                'string',
                'required',
            ],
            'duration' => [
                'string',
                'required',
            ],
            'days_of_week' => [
                'string',
                'required',
            ],
            'start_from' => [
                'string',
                'required',
            ],
            'snooze' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],

            'care_reminders.*' => [
                'integer',
            ],
            'care_reminders' => [
                'required',
                'array',
            ],
        ];
    }
}
