<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTemplateRequest;
use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Models\Team;
use App\Models\Template;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('template_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $templates = Template::with(['team'])->get();

        $teams = Team::get();

        return view('admin.templates.index', compact('teams', 'templates'));
    }

    public function create()
    {
        abort_if(Gate::denies('template_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.templates.create');
    }

    public function store(StoreTemplateRequest $request)
    {
        $template = Template::create($request->all());

        return redirect()->route('admin.templates.index');
    }

    public function edit(Template $template)
    {
        abort_if(Gate::denies('template_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $template->load('team');

        return view('admin.templates.edit', compact('template'));
    }

    public function update(UpdateTemplateRequest $request, Template $template)
    {
        $template->update($request->all());

        return redirect()->route('admin.templates.index');
    }

    public function show(Template $template)
    {
        abort_if(Gate::denies('template_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $template->load('team', 'templateWebmenus', 'templateArtikels');

        return view('admin.templates.show', compact('template'));
    }

    public function destroy(Template $template)
    {
        abort_if(Gate::denies('template_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $template->delete();

        return back();
    }

    public function massDestroy(MassDestroyTemplateRequest $request)
    {
        $templates = Template::find(request('ids'));

        foreach ($templates as $template) {
            $template->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
