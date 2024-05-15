<div class="m-3">
    @can('mitglied_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mitglieds.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.mitglied.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.mitglied.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-tagMitglieds">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.profile') }}
                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.anrede') }}
                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.organ') }}
                            </th>
                            <th>
                                {{ trans('cruds.mitglied.fields.tag') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mitglieds as $key => $mitglied)
                            <tr data-entry-id="{{ $mitglied->id }}">
                                <td>

                                </td>
                                <td>
                                    @if($mitglied->profile)
                                        <a href="{{ $mitglied->profile->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $mitglied->profile->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $mitglied->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mitglied->type->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    {{ $mitglied->anrede ?? '' }}
                                </td>
                                <td>
                                    @foreach($mitglied->organs as $key => $item)
                                        <span class="badge badge-info">{{ $item->bezeichnung }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($mitglied->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->bezeichnung }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('mitglied_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.mitglieds.show', $mitglied->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('mitglied_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.mitglieds.edit', $mitglied->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('mitglied_delete')
                                        <form action="{{ route('admin.mitglieds.destroy', $mitglied->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mitglied_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mitglieds.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-tagMitglieds:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection