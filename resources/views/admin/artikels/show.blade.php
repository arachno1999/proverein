@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artikel.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artikels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.id') }}
                        </th>
                        <td>
                            {{ $artikel->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $artikel->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.menu') }}
                        </th>
                        <td>
                            {{ $artikel->menu->bezeichnung ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.sichtbar') }}
                        </th>
                        <td>
                            {{ $artikel->sichtbar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.end') }}
                        </th>
                        <td>
                            {{ $artikel->end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.intro') }}
                        </th>
                        <td>
                            {!! $artikel->intro !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.fulltext') }}
                        </th>
                        <td>
                            {!! $artikel->fulltext !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.images') }}
                        </th>
                        <td>
                            @foreach($artikel->images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.download') }}
                        </th>
                        <td>
                            @foreach($artikel->download as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.position') }}
                        </th>
                        <td>
                            {{ App\Models\Artikel::POSITION_RADIO[$artikel->position] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.reihenfolge') }}
                        </th>
                        <td>
                            {{ $artikel->reihenfolge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.template') }}
                        </th>
                        <td>
                            {{ $artikel->template->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artikel.fields.submenu') }}
                        </th>
                        <td>
                            {{ $artikel->submenu->bezeichnung ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artikels.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection