@can('reminder_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.reminders.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.reminder.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.reminder.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userReminderReminders">
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
                <tbody>
                    @foreach($reminders as $key => $reminder)
                        <tr data-entry-id="{{ $reminder->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $reminder->id ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->applying ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->doses ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->times ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->duration ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->days_of_week ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->start_from ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->time ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->snooze ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->date ?? '' }}
                            </td>
                            <td>
                                {{ $reminder->user_reminder->user ?? '' }}
                            </td>
                            <td>
                                @foreach($reminder->care_reminders as $key => $item)
                                    <span class="badge badge-info">{{ $item->careby }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('reminder_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.reminders.show', $reminder->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('reminder_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.reminders.edit', $reminder->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('reminder_delete')
                                    <form action="{{ route('admin.reminders.destroy', $reminder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('reminder_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.reminders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userReminderReminders:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
