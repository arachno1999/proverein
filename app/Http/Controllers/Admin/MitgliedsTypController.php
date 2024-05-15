<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMitgliedsTypRequest;
use App\Http\Requests\StoreMitgliedsTypRequest;
use App\Http\Requests\UpdateMitgliedsTypRequest;
use App\Models\MitgliedsTyp;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MitgliedsTypController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('mitglieds_typ_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitgliedsTyps = MitgliedsTyp::with(['team'])->get();

        $teams = Team::get();

        return view('admin.mitgliedsTyps.index', compact('mitgliedsTyps', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('mitglieds_typ_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mitgliedsTyps.create');
    }

    public function store(StoreMitgliedsTypRequest $request)
    {
        $mitgliedsTyp = MitgliedsTyp::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mitgliedsTyp->id]);
        }

        return redirect()->route('admin.mitglieds-typs.index');
    }

    public function edit(MitgliedsTyp $mitgliedsTyp)
    {
        abort_if(Gate::denies('mitglieds_typ_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitgliedsTyp->load('team');

        return view('admin.mitgliedsTyps.edit', compact('mitgliedsTyp'));
    }

    public function update(UpdateMitgliedsTypRequest $request, MitgliedsTyp $mitgliedsTyp)
    {
        $mitgliedsTyp->update($request->all());

        return redirect()->route('admin.mitglieds-typs.index');
    }

    public function show(MitgliedsTyp $mitgliedsTyp)
    {
        abort_if(Gate::denies('mitglieds_typ_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitgliedsTyp->load('team', 'typeMitglieds');

        return view('admin.mitgliedsTyps.show', compact('mitgliedsTyp'));
    }

    public function destroy(MitgliedsTyp $mitgliedsTyp)
    {
        abort_if(Gate::denies('mitglieds_typ_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mitgliedsTyp->delete();

        return back();
    }

    public function massDestroy(MassDestroyMitgliedsTypRequest $request)
    {
        $mitgliedsTyps = MitgliedsTyp::find(request('ids'));

        foreach ($mitgliedsTyps as $mitgliedsTyp) {
            $mitgliedsTyp->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mitglieds_typ_create') && Gate::denies('mitglieds_typ_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MitgliedsTyp();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
