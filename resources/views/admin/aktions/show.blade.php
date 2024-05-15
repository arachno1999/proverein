@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.aktion.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aktions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.id') }}
                        </th>
                        <td>
                            {{ $aktion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $aktion->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.text') }}
                        </th>
                        <td>
                            {{ $aktion->text->bezeichnung ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $aktion->beschreibung !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.start') }}
                        </th>
                        <td>
                            {{ $aktion->start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.target') }}
                        </th>
                        <td>
                            @foreach($aktion->targets as $key => $target)
                                <span class="label label-info">{{ $target->bezeichnung }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.aktion.fields.ort') }}
                        </th>
                        <td>
                            {{ $aktion->ort->bezeichnung ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.aktions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection