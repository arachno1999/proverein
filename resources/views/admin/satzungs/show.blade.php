@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.satzung.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.satzungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.satzung.fields.id') }}
                        </th>
                        <td>
                            {{ $satzung->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.satzung.fields.paragraph') }}
                        </th>
                        <td>
                            {{ $satzung->paragraph }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.satzung.fields.titel') }}
                        </th>
                        <td>
                            {{ $satzung->titel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.satzung.fields.inhalt') }}
                        </th>
                        <td>
                            {!! $satzung->inhalt !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.satzungs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection