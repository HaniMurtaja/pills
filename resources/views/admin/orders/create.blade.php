@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="service_price">{{ trans('cruds.order.fields.service_price') }}</label>
                <input class="form-control {{ $errors->has('service_price') ? 'is-invalid' : '' }}" type="text" name="service_price" id="service_price" value="{{ old('service_price', '') }}">
                @if($errors->has('service_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.service_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="payment_method">{{ trans('cruds.order.fields.payment_method') }}</label>
                <input class="form-control {{ $errors->has('payment_method') ? 'is-invalid' : '' }}" type="number" name="payment_method" id="payment_method" value="{{ old('payment_method', '') }}" step="1" required>
                @if($errors->has('payment_method'))
                    <div class="invalid-feedback">
                        {{ $errors->first('payment_method') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.payment_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_description">{{ trans('cruds.order.fields.service_description') }}</label>
                <textarea class="form-control {{ $errors->has('service_description') ? 'is-invalid' : '' }}" name="service_description" id="service_description">{{ old('service_description') }}</textarea>
                @if($errors->has('service_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.service_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="arriving_date">{{ trans('cruds.order.fields.arriving_date') }}</label>
                <input class="form-control date {{ $errors->has('arriving_date') ? 'is-invalid' : '' }}" type="text" name="arriving_date" id="arriving_date" value="{{ old('arriving_date') }}" required>
                @if($errors->has('arriving_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('arriving_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.arriving_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_orders">{{ trans('cruds.order.fields.user_orders') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('user_orders') ? 'is-invalid' : '' }}" name="user_orders[]" id="user_orders" multiple>
                    @foreach($user_orders as $id => $user_order)
                        <option value="{{ $id }}" {{ in_array($id, old('user_orders', [])) ? 'selected' : '' }}>{{ $user_order }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_orders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_orders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.user_orders_helper') }}</span>
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