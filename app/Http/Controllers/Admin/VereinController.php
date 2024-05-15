<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVereinRequest;
use App\Http\Requests\StoreVereinRequest;
use App\Http\Requests\UpdateVereinRequest;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Verein;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VereinController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('verein_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vereins = Verein::with(['tags', 'team', 'media'])->get();

        $tags = Tag::get();

        $teams = Team::get();

        return view('admin.vereins.index', compact('tags', 'teams', 'vereins'));
    }

    public function create()
    {
        abort_if(Gate::denies('verein_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        return view('admin.vereins.create', compact('tags'));
    }

    public function store(StoreVereinRequest $request)
    {
        $verein = Verein::create($request->all());
        $verein->tags()->sync($request->input('tags', []));
        if ($request->input('logo', false)) {
            $verein->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $verein->id]);
        }

        return redirect()->route('admin.vereins.index');
    }

    public function edit(Verein $verein)
    {
        abort_if(Gate::denies('verein_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        $verein->load('tags', 'team');

        return view('admin.vereins.edit', compact('tags', 'verein'));
    }

    public function update(UpdateVereinRequest $request, Verein $verein)
    {
        $verein->update($request->all());
        $verein->tags()->sync($request->input('tags', []));
        if ($request->input('logo', false)) {
            if (! $verein->logo || $request->input('logo') !== $verein->logo->file_name) {
                if ($verein->logo) {
                    $verein->logo->delete();
                }
                $verein->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($verein->logo) {
            $verein->logo->delete();
        }

        return redirect()->route('admin.vereins.index');
    }

    public function show(Verein $verein)
    {
        abort_if(Gate::denies('verein_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verein->load('tags', 'team');

        return view('admin.vereins.show', compact('verein'));
    }

    public function destroy(Verein $verein)
    {
        abort_if(Gate::denies('verein_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $verein->delete();

        return back();
    }

    public function massDestroy(MassDestroyVereinRequest $request)
    {
        $vereins = Verein::find(request('ids'));

        foreach ($vereins as $verein) {
            $verein->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('verein_create') && Gate::denies('verein_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Verein();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
