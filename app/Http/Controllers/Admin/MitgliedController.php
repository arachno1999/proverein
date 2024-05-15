<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMitgliedRequest;
use App\Http\Requests\StoreMitgliedRequest;
use App\Http\Requests\UpdateMitgliedRequest;
use App\Models\Mitglied;
use App\Models\MitgliedsTyp;
use App\Models\Organe;
use App\Models\Tag;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MitgliedController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mitglied_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitglieds = Mitglied::with(['type', 'organs', 'tags', 'team', 'media'])->get();

        $mitglieds_typs = MitgliedsTyp::get();

        $organes = Organe::get();

        $tags = Tag::get();

        $teams = Team::get();

        return view('admin.mitglieds.index', compact('mitglieds', 'mitglieds_typs', 'organes', 'tags', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('mitglied_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MitgliedsTyp::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organs = Organe::pluck('bezeichnung', 'id');

        $tags = Tag::pluck('bezeichnung', 'id');

        return view('admin.mitglieds.create', compact('organs', 'tags', 'types'));
    }

    public function store(StoreMitgliedRequest $request)
    {
        $mitglied = Mitglied::create($request->all());
        $mitglied->organs()->sync($request->input('organs', []));
        $mitglied->tags()->sync($request->input('tags', []));
        if ($request->input('profile', false)) {
            $mitglied->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mitglied->id]);
        }

        return redirect()->route('admin.mitglieds.index');
    }

    public function edit(Mitglied $mitglied)
    {
        abort_if(Gate::denies('mitglied_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MitgliedsTyp::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organs = Organe::pluck('bezeichnung', 'id');

        $tags = Tag::pluck('bezeichnung', 'id');

        $mitglied->load('type', 'organs', 'tags', 'team');

        return view('admin.mitglieds.edit', compact('mitglied', 'organs', 'tags', 'types'));
    }

    public function update(UpdateMitgliedRequest $request, Mitglied $mitglied)
    {
        $mitglied->update($request->all());
        $mitglied->organs()->sync($request->input('organs', []));
        $mitglied->tags()->sync($request->input('tags', []));
        if ($request->input('profile', false)) {
            if (! $mitglied->profile || $request->input('profile') !== $mitglied->profile->file_name) {
                if ($mitglied->profile) {
                    $mitglied->profile->delete();
                }
                $mitglied->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
            }
        } elseif ($mitglied->profile) {
            $mitglied->profile->delete();
        }

        return redirect()->route('admin.mitglieds.index');
    }

    public function show(Mitglied $mitglied)
    {
        abort_if(Gate::denies('mitglied_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitglied->load('type', 'organs', 'tags', 'team');

        return view('admin.mitglieds.show', compact('mitglied'));
    }

    public function destroy(Mitglied $mitglied)
    {
        abort_if(Gate::denies('mitglied_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitglied->delete();

        return back();
    }

    public function massDestroy(MassDestroyMitgliedRequest $request)
    {
        $mitglieds = Mitglied::find(request('ids'));

        foreach ($mitglieds as $mitglied) {
            $mitglied->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mitglied_create') && Gate::denies('mitglied_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Mitglied();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
