<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySatzungRequest;
use App\Http\Requests\StoreSatzungRequest;
use App\Http\Requests\UpdateSatzungRequest;
use App\Models\Satzung;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SatzungController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('satzung_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satzungs = Satzung::with(['team'])->get();

        $teams = Team::get();

        return view('admin.satzungs.index', compact('satzungs', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('satzung_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satzungs.create');
    }

    public function store(StoreSatzungRequest $request)
    {
        $satzung = Satzung::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $satzung->id]);
        }

        return redirect()->route('admin.satzungs.index');
    }

    public function edit(Satzung $satzung)
    {
        abort_if(Gate::denies('satzung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satzung->load('team');

        return view('admin.satzungs.edit', compact('satzung'));
    }

    public function update(UpdateSatzungRequest $request, Satzung $satzung)
    {
        $satzung->update($request->all());

        return redirect()->route('admin.satzungs.index');
    }

    public function show(Satzung $satzung)
    {
        abort_if(Gate::denies('satzung_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satzung->load('team');

        return view('admin.satzungs.show', compact('satzung'));
    }

    public function destroy(Satzung $satzung)
    {
        abort_if(Gate::denies('satzung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satzung->delete();

        return back();
    }

    public function massDestroy(MassDestroySatzungRequest $request)
    {
        $satzungs = Satzung::find(request('ids'));

        foreach ($satzungs as $satzung) {
            $satzung->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('satzung_create') && Gate::denies('satzung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Satzung();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
