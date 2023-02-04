@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subscription.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscriptions.update", [$subscription->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user">{{ trans('cruds.subscription.fields.user') }}</label>
                <input class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" type="number" name="user" id="user" value="{{ old('user', $subscription->user) }}" step="1" required>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="payment_method">{{ trans('cruds.subscription.fields.payment_method') }}</label>
                <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="number" name="payment_method" id="payment_method" value="{{ old('payment_method', $subscription->payment_method) }}" step="1">
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="subsription_date">{{ trans('cruds.subscription.fields.subsription_date') }}</label>
                <input class="form-control date {{ $errors->has('subsription_date') ? 'is-invalid' : '' }}" type="text" name="subsription_date" id="subsription_date" value="{{ old('subsription_date', $subscription->subsription_date) }}" required>
                @if($errors->has('subsription_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subsription_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.subsription_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_subs_id">{{ trans('cruds.subscription.fields.user_subs') }}</label>
                <select class="form-control select2 {{ $errors->has('user_subs') ? 'is-invalid' : '' }}" name="user_subs_id" id="user_subs_id">
                    @foreach($user_subs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_subs_id') ? old('user_subs_id') : $subscription->user_subs->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_subs'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_subs') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subscription.fields.user_subs_helper') }}</span>
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