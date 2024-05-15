@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mitglied.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mitglieds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.id') }}
                        </th>
                        <td>
                            {{ $mitglied->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.profile') }}
                        </th>
                        <td>
                            @if($mitglied->profile)
                                <a href="{{ $mitglied->profile->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $mitglied->profile->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.name') }}
                        </th>
                        <td>
                            {{ $mitglied->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.birthday') }}
                        </th>
                        <td>
                            {{ $mitglied->birthday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.type') }}
                        </th>
                        <td>
                            {{ $mitglied->type->bezeichnung ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.anrede') }}
                        </th>
                        <td>
                            {{ $mitglied->anrede }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.email') }}
                        </th>
                        <td>
                            {{ $mitglied->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.eintritt') }}
                        </th>
                        <td>
                            {{ $mitglied->eintritt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.austritt') }}
                        </th>
                        <td>
                            {{ $mitglied->austritt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.phone') }}
                        </th>
                        <td>
                            {{ $mitglied->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.anschrift') }}
                        </th>
                        <td>
                            {{ $mitglied->anschrift }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.organ') }}
                        </th>
                        <td>
                            @foreach($mitglied->organs as $key => $organ)
                                <span class="label label-info">{{ $organ->bezeichnung }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mitglied.fields.tag') }}
                        </th>
                        <td>
                            @foreach($mitglied->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->bezeichnung }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.mitglieds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection