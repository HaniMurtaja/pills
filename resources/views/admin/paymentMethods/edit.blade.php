@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentMethod.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-methods.update", [$paymentMethod->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.paymentMethod.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $paymentMethod->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="card_number">{{ trans('cruds.paymentMethod.fields.card_number') }}</label>
                <input class="form-control {{ $errors->has('card_number') ? 'is-invalid' : '' }}" type="text" name="card_number" id="card_number" value="{{ old('card_number', $paymentMethod->card_number) }}" required>
                @if($errors->has('card_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('card_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.card_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expired_date">{{ trans('cruds.paymentMethod.fields.expired_date') }}</label>
                <input class="form-control date {{ $errors->has('expired_date') ? 'is-invalid' : '' }}" type="text" name="expired_date" id="expired_date" value="{{ old('expired_date', $paymentMethod->expired_date) }}" required>
                @if($errors->has('expired_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expired_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.expired_date_helper') }}</span>
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