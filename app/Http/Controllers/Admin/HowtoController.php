<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHowtoRequest;
use App\Http\Requests\StoreHowtoRequest;
use App\Http\Requests\UpdateHowtoRequest;
use App\Models\Howto;
use App\Models\Tag;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HowtoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('howto_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $howtos = Howto::with(['tags', 'team'])->get();

        $tags = Tag::get();

        $teams = Team::get();

        return view('admin.howtos.index', compact('howtos', 'tags', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('howto_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        return view('admin.howtos.create', compact('tags'));
    }

    public function store(StoreHowtoRequest $request)
    {
        $howto = Howto::create($request->all());
        $howto->tags()->sync($request->input('tags', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $howto->id]);
        }

        return redirect()->route('admin.howtos.index');
    }

    public function edit(Howto $howto)
    {
        abort_if(Gate::denies('howto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        $howto->load('tags', 'team');

        return view('admin.howtos.edit', compact('howto', 'tags'));
    }

    public function update(UpdateHowtoRequest $request, Howto $howto)
    {
        $howto->update($request->all());
        $howto->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.howtos.index');
    }

    public function show(Howto $howto)
    {
        abort_if(Gate::denies('howto_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $howto->load('tags', 'team');

        return view('admin.howtos.show', compact('howto'));
    }

    public function destroy(Howto $howto)
    {
        abort_if(Gate::denies('howto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $howto->delete();

        return back();
    }

    public function massDestroy(MassDestroyHowtoRequest $request)
    {
        $howtos = Howto::find(request('ids'));

        foreach ($howtos as $howto) {
            $howto->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('howto_create') && Gate::denies('howto_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Howto();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
