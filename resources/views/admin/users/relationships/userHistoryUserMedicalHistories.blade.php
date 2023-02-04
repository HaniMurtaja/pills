@can('user_medical_history_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-medical-histories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userMedicalHistory.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userMedicalHistory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userHistoryUserMedicalHistories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.disease_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.user_history') }}
                        </th>
                        <th>
                            {{ trans('cruds.userMedicalHistory.fields.care_history') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userMedicalHistories as $key => $userMedicalHistory)
                        <tr data-entry-id="{{ $userMedicalHistory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userMedicalHistory->id ?? '' }}
                            </td>
                            <td>
                                {{ $userMedicalHistory->disease_name ?? '' }}
                            </td>
                            <td>
                                {{ $userMedicalHistory->description ?? '' }}
                            </td>
                            <td>
                                {{ $userMedicalHistory->user_history->user ?? '' }}
                            </td>
                            <td>
                                @foreach($userMedicalHistory->care_histories as $key => $item)
                                    <span class="badge badge-info">{{ $item->careby }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_medical_history_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-medical-histories.show', $userMedicalHistory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_medical_history_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-medical-histories.edit', $userMedicalHistory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_medical_history_delete')
                                    <form action="{{ route('admin.user-medical-histories.destroy', $userMedicalHistory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_medical_history_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-medical-histories.massDestroy') }}",
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
  let table = $('.datatable-userHistoryUserMedicalHistories:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection