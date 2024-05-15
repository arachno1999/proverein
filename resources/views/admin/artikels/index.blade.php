@extends('layouts.admin')
@section('content')
@can('artikel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.artikels.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.artikel.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.artikel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Artikel">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.bezeichnung') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.menu') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.sichtbar') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.end') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.position') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.reihenfolge') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.template') }}
                        </th>
                        <th>
                            {{ trans('cruds.artikel.fields.submenu') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($webmenus as $key => $item)
                                    <option value="{{ $item->bezeichnung }}">{{ $item->bezeichnung }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Artikel::POSITION_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($templates as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($submenus as $key => $item)
                                    <option value="{{ $item->bezeichnung }}">{{ $item->bezeichnung }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artikels as $key => $artikel)
                        <tr data-entry-id="{{ $artikel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $artikel->bezeichnung ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->menu->bezeichnung ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->sichtbar ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->end ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Artikel::POSITION_RADIO[$artikel->position] ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->reihenfolge ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->template->name ?? '' }}
                            </td>
                            <td>
                                {{ $artikel->submenu->bezeichnung ?? '' }}
                            </td>
                            <td>
                                @can('artikel_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.artikels.show', $artikel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('artikel_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.artikels.edit', $artikel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('artikel_delete')
                                    <form action="{{ route('admin.artikels.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('artikel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.artikels.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Artikel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection