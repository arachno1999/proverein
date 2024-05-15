@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.veranstaltung.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.veranstaltungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.id') }}
                        </th>
                        <td>
                            {{ $veranstaltung->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $veranstaltung->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.from') }}
                        </th>
                        <td>
                            {{ $veranstaltung->from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.to') }}
                        </th>
                        <td>
                            {{ $veranstaltung->to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $veranstaltung->beschreibung !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.veranstaltung.fields.image') }}
                        </th>
                        <td>
                            @foreach($veranstaltung->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.veranstaltungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection