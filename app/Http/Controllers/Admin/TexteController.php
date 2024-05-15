<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTexteRequest;
use App\Http\Requests\StoreTexteRequest;
use App\Http\Requests\UpdateTexteRequest;
use App\Models\Team;
use App\Models\Texte;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TexteController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('texte_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $textes = Texte::with(['team'])->get();

        $teams = Team::get();

        return view('admin.textes.index', compact('teams', 'textes'));
    }

    public function create()
    {
        abort_if(Gate::denies('texte_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.textes.create');
    }

    public function store(StoreTexteRequest $request)
    {
        $texte = Texte::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $texte->id]);
        }

        return redirect()->route('admin.textes.index');
    }

    public function edit(Texte $texte)
    {
        abort_if(Gate::denies('texte_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $texte->load('team');

        return view('admin.textes.edit', compact('texte'));
    }

    public function update(UpdateTexteRequest $request, Texte $texte)
    {
        $texte->update($request->all());

        return redirect()->route('admin.textes.index');
    }

    public function show(Texte $texte)
    {
        abort_if(Gate::denies('texte_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $texte->load('team', 'textAktions');

        return view('admin.textes.show', compact('texte'));
    }

    public function destroy(Texte $texte)
    {
        abort_if(Gate::denies('texte_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $texte->delete();

        return back();
    }

    public function massDestroy(MassDestroyTexteRequest $request)
    {
        $textes = Texte::find(request('ids'));

        foreach ($textes as $texte) {
            $texte->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('texte_create') && Gate::denies('texte_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Texte();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
