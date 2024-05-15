<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFinanzenRequest;
use App\Http\Requests\StoreFinanzenRequest;
use App\Http\Requests\UpdateFinanzenRequest;
use App\Models\Finanzen;
use App\Models\Finanzkategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinanzenController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finanzen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzens = Finanzen::with(['kategorie', 'team'])->get();

        $finanzkategoriens = Finanzkategorien::get();

        $teams = Team::get();

        return view('admin.finanzens.index', compact('finanzens', 'finanzkategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('finanzen_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Finanzkategorien::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.finanzens.create', compact('kategories'));
    }

    public function store(StoreFinanzenRequest $request)
    {
        $finanzen = Finanzen::create($request->all());

        return redirect()->route('admin.finanzens.index');
    }

    public function edit(Finanzen $finanzen)
    {
        abort_if(Gate::denies('finanzen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Finanzkategorien::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $finanzen->load('kategorie', 'team');

        return view('admin.finanzens.edit', compact('finanzen', 'kategories'));
    }

    public function update(UpdateFinanzenRequest $request, Finanzen $finanzen)
    {
        $finanzen->update($request->all());

        return redirect()->route('admin.finanzens.index');
    }

    public function show(Finanzen $finanzen)
    {
        abort_if(Gate::denies('finanzen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzen->load('kategorie', 'team');

        return view('admin.finanzens.show', compact('finanzen'));
    }

    public function destroy(Finanzen $finanzen)
    {
        abort_if(Gate::denies('finanzen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzen->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinanzenRequest $request)
    {
        $finanzens = Finanzen::find(request('ids'));

        foreach ($finanzens as $finanzen) {
            $finanzen->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
