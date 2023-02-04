@can('user_doc_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-docs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userDoc.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userDoc.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-careDocsUserDocs">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.file') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.care_docs') }}
                        </th>
                        <th>
                            {{ trans('cruds.userDoc.fields.user_doc') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userDocs as $key => $userDoc)
                        <tr data-entry-id="{{ $userDoc->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userDoc->id ?? '' }}
                            </td>
                            <td>
                                {{ $userDoc->date ?? '' }}
                            </td>
                            <td>
                                {{ $userDoc->description ?? '' }}
                            </td>
                            <td>
                                @if($userDoc->file)
                                    <a href="{{ $userDoc->file->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($userDoc->care_docs as $key => $item)
                                    <span class="badge badge-info">{{ $item->careby }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $userDoc->user_doc->user ?? '' }}
                            </td>
                            <td>
                                @can('user_doc_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-docs.show', $userDoc->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_doc_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-docs.edit', $userDoc->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_doc_delete')
                                    <form action="{{ route('admin.user-docs.destroy', $userDoc->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('user_doc_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-docs.massDestroy') }}",
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
  let table = $('.datatable-careDocsUserDocs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection