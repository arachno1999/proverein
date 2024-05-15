@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.verein.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vereins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.id') }}
                        </th>
                        <td>
                            {{ $verein->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.name') }}
                        </th>
                        <td>
                            {{ $verein->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $verein->beschreibung !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.gruendung') }}
                        </th>
                        <td>
                            {{ $verein->gruendung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.register') }}
                        </th>
                        <td>
                            {{ $verein->register }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.logo') }}
                        </th>
                        <td>
                            @if($verein->logo)
                                <a href="{{ $verein->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $verein->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.verein.fields.tag') }}
                        </th>
                        <td>
                            @foreach($verein->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->bezeichnung }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vereins.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection