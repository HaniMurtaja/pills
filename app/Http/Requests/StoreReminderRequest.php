<?php

namespace App\Http\Requests;

use App\Models\Reminder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReminderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reminder_create');
    }

    public function rules()
    {
        return [
            'doses' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'duration' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'times' => [
                'string',
                'required',
            ],
            'start_from' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'days_of_week' => [
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
