@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reminder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reminders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.id') }}
                        </th>
                        <td>
                            {{ $reminder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.doses') }}
                        </th>
                        <td>
                            {{ $reminder->doses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.duration') }}
                        </th>
                        <td>
                            {{ $reminder->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.times') }}
                        </th>
                        <td>
                            {{ $reminder->times }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.start_from') }}
                        </th>
                        <td>
                            {{ $reminder->start_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.days_of_week') }}
                        </th>
                        <td>
                            {{ $reminder->days_of_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.snooze') }}
                        </th>
                        <td>
                            {{ $reminder->snooze }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.date') }}
                        </th>
                        <td>
                            {{ $reminder->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.user_reminder') }}
                        </th>
                        <td>
                            {{ $reminder->user_reminder->user ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reminder.fields.care_reminder') }}
                        </th>
                        <td>
                            @foreach($reminder->care_reminders as $key => $care_reminder)
                                <span class="label label-info">{{ $care_reminder->careby }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.reminders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection