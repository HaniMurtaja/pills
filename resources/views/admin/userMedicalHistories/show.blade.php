@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userMedicalHistory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-medical-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.id') }}
                        </th>
                        <td>
                            {{ $userMedicalHistory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.disease_name') }}
                        </th>
                        <td>
                            {{ $userMedicalHistory->disease_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.description') }}
                        </th>
                        <td>
                            {{ $userMedicalHistory->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.user_history') }}
                        </th>
                        <td>
                            {{ $userMedicalHistory->user_history->user ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.care_history') }}
                        </th>
                        <td>
                            @foreach($userMedicalHistory->care_histories as $key => $care_history)
                                <span class="label label-info">{{ $care_history->careby }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-medical-histories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection