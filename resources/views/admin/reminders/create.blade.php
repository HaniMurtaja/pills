@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.reminder.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reminders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="doses">{{ trans('cruds.reminder.fields.doses') }}</label>
                <input class="form-control {{ $errors->has('doses') ? 'is-invalid' : '' }}" type="number" name="doses" id="doses" value="{{ old('doses', '') }}" step="1" required>
                @if($errors->has('doses'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doses') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.doses_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.reminder.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', '') }}" step="1" required>
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="times">{{ trans('cruds.reminder.fields.times') }}</label>
                <input class="form-control {{ $errors->has('times') ? 'is-invalid' : '' }}" type="text" name="times" id="times" value="{{ old('times', '') }}" required>
                @if($errors->has('times'))
                    <div class="invalid-feedback">
                        {{ $errors->first('times') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.times_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_from">{{ trans('cruds.reminder.fields.start_from') }}</label>
                <input class="form-control {{ $errors->has('start_from') ? 'is-invalid' : '' }}" type="number" name="start_from" id="start_from" value="{{ old('start_from', '') }}" step="1" required>
                @if($errors->has('start_from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_from') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.start_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="days_of_week">{{ trans('cruds.reminder.fields.days_of_week') }}</label>
                <input class="form-control {{ $errors->has('days_of_week') ? 'is-invalid' : '' }}" type="text" name="days_of_week" id="days_of_week" value="{{ old('days_of_week', '') }}" required>
                @if($errors->has('days_of_week'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days_of_week') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.days_of_week_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="snooze">{{ trans('cruds.reminder.fields.snooze') }}</label>
                <input class="form-control {{ $errors->has('snooze') ? 'is-invalid' : '' }}" type="text" name="snooze" id="snooze" value="{{ old('snooze', '') }}" required>
                @if($errors->has('snooze'))
                    <div class="invalid-feedback">
                        {{ $errors->first('snooze') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.snooze_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.reminder.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_reminder_id">{{ trans('cruds.reminder.fields.user_reminder') }}</label>
                <select class="form-control select2 {{ $errors->has('user_reminder') ? 'is-invalid' : '' }}" name="user_reminder_id" id="user_reminder_id">
                    @foreach($user_reminders as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_reminder_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_reminder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_reminder') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.user_reminder_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="care_reminders">{{ trans('cruds.reminder.fields.care_reminder') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('care_reminders') ? 'is-invalid' : '' }}" name="care_reminders[]" id="care_reminders" multiple required>
                    @foreach($care_reminders as $id => $care_reminder)
                        <option value="{{ $id }}" {{ in_array($id, old('care_reminders', [])) ? 'selected' : '' }}>{{ $care_reminder }}</option>
                    @endforeach
                </select>
                @if($errors->has('care_reminders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('care_reminders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.reminder.fields.care_reminder_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection