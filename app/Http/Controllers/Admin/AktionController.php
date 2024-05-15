<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAktionRequest;
use App\Http\Requests\StoreAktionRequest;
use App\Http\Requests\UpdateAktionRequest;
use App\Models\Aktion;
use App\Models\Organe;
use App\Models\Ort;
use App\Models\Team;
use App\Models\Texte;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AktionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('aktion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aktions = Aktion::with(['text', 'targets', 'ort', 'team'])->get();

        $textes = Texte::get();

        $organes = Organe::get();

        $orts = Ort::get();

        $teams = Team::get();

        return view('admin.aktions.index', compact('aktions', 'organes', 'orts', 'teams', 'textes'));
    }

    public function create()
    {
        abort_if(Gate::denies('aktion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $texts = Texte::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $targets = Organe::pluck('bezeichnung', 'id');

        $orts = Ort::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.aktions.create', compact('orts', 'targets', 'texts'));
    }

    public function store(StoreAktionRequest $request)
    {
        $aktion = Aktion::create($request->all());
        $aktion->targets()->sync($request->input('targets', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $aktion->id]);
        }

        return redirect()->route('admin.aktions.index');
    }

    public function edit(Aktion $aktion)
    {
        abort_if(Gate::denies('aktion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $texts = Texte::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $targets = Organe::pluck('bezeichnung', 'id');

        $orts = Ort::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aktion->load('text', 'targets', 'ort', 'team');

        return view('admin.aktions.edit', compact('aktion', 'orts', 'targets', 'texts'));
    }

    public function update(UpdateAktionRequest $request, Aktion $aktion)
    {
        $aktion->update($request->all());
        $aktion->targets()->sync($request->input('targets', []));

        return redirect()->route('admin.aktions.index');
    }

    public function show(Aktion $aktion)
    {
        abort_if(Gate::denies('aktion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aktion->load('text', 'targets', 'ort', 'team');

        return view('admin.aktions.show', compact('aktion'));
    }

    public function destroy(Aktion $aktion)
    {
        abort_if(Gate::denies('aktion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $aktion->delete();

        return back();
    }

    public function massDestroy(MassDestroyAktionRequest $request)
    {
        $aktions = Aktion::find(request('ids'));

        foreach ($aktions as $aktion) {
            $aktion->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('aktion_create') && Gate::denies('aktion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Aktion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
