@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.user') }}
                        </th>
                        <td>
                            {{ $user->user }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.image') }}
                        </th>
                        <td>
                            @if($user->image)
                                <a href="{{ $user->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $user->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.address') }}
                        </th>
                        <td>
                            {{ $user->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.user.fields.carebies') }}--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            @foreach($user->carebies as $key => $carebies)--}}
{{--                                <span class="label label-info">{{ $carebies->careby }}</span>--}}
{{--                            @endforeach--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#user_user_healths" role="tab" data-toggle="tab">
                {{ trans('cruds.userHealth.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_reminder_reminders" role="tab" data-toggle="tab">
                {{ trans('cruds.reminder.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_med_medicines" role="tab" data-toggle="tab">
                {{ trans('cruds.medicine.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_doc_user_docs" role="tab" data-toggle="tab">
                {{ trans('cruds.userDoc.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_history_user_medical_histories" role="tab" data-toggle="tab">
                {{ trans('cruds.userMedicalHistory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_subs_subscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.subscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                {{ trans('cruds.userAlert.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_orders_orders" role="tab" data-toggle="tab">
                {{ trans('cruds.order.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_user_healths">
            @includeIf('admin.users.relationships.userUserHealths', ['userHealths' => $user->userUserHealths])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_reminder_reminders">
            @includeIf('admin.users.relationships.userReminderReminders', ['reminders' => $user->userReminderReminders])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_med_medicines">
            @includeIf('admin.users.relationships.userMedMedicines', ['medicines' => $user->userMedMedicines])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_doc_user_docs">
            @includeIf('admin.users.relationships.userDocUserDocs', ['userDocs' => $user->userDocUserDocs])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_history_user_medical_histories">
            @includeIf('admin.users.relationships.userHistoryUserMedicalHistories', ['userMedicalHistories' => $user->userHistoryUserMedicalHistories])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_subs_subscriptions">
            @includeIf('admin.users.relationships.userSubsSubscriptions', ['subscriptions' => $user->userSubsSubscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_user_alerts">
            @includeIf('admin.users.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_orders_orders">
            @includeIf('admin.users.relationships.userOrdersOrders', ['orders' => $user->userOrdersOrders])
        </div>
    </div>
</div>

@endsection