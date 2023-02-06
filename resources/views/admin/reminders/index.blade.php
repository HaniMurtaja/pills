@extends('layouts.admin')
@section('content')
@can('reminder_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reminders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.reminder.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Reminder', 'route' => 'admin.reminders.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.reminder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Reminder">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.applying') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.doses') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.times') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.duration') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.days_of_week') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.start_from') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.time') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.snooze') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.user_reminder') }}
                    </th>
                    <th>
                        {{ trans('cruds.reminder.fields.care_reminder') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('reminder_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reminders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.reminders.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'applying', name: 'applying' },
{ data: 'doses', name: 'doses' },
{ data: 'times', name: 'times' },
{ data: 'duration', name: 'duration' },
{ data: 'days_of_week', name: 'days_of_week' },
{ data: 'start_from', name: 'start_from' },
{ data: 'time', name: 'time' },
{ data: 'snooze', name: 'snooze' },
{ data: 'date', name: 'date' },
{ data: 'user_reminder_user', name: 'user_reminder.user' },
{ data: 'care_reminder', name: 'care_reminders.careby' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Reminder').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection
