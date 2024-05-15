@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.finanzen.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finanzens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzen.fields.id') }}
                        </th>
                        <td>
                            {{ $finanzen->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzen.fields.datum') }}
                        </th>
                        <td>
                            {{ $finanzen->datum }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzen.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $finanzen->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzen.fields.betrag') }}
                        </th>
                        <td>
                            {{ $finanzen->betrag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzen.fields.kategorie') }}
                        </th>
                        <td>
                            {{ $finanzen->kategorie->bezeichnung ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finanzens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection