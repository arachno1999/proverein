<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCounterRequest;
use App\Http\Requests\StoreCounterRequest;
use App\Http\Requests\UpdateCounterRequest;
use App\Models\Counter;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CounterController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('counter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counters = Counter::with(['team'])->get();

        $teams = Team::get();

        return view('admin.counters.index', compact('counters', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('counter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.counters.create');
    }

    public function store(StoreCounterRequest $request)
    {
        $counter = Counter::create($request->all());

        return redirect()->route('admin.counters.index');
    }

    public function edit(Counter $counter)
    {
        abort_if(Gate::denies('counter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counter->load('team');

        return view('admin.counters.edit', compact('counter'));
    }

    public function update(UpdateCounterRequest $request, Counter $counter)
    {
        $counter->update($request->all());

        return redirect()->route('admin.counters.index');
    }

    public function show(Counter $counter)
    {
        abort_if(Gate::denies('counter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counter->load('team');

        return view('admin.counters.show', compact('counter'));
    }

    public function destroy(Counter $counter)
    {
        abort_if(Gate::denies('counter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $counter->delete();

        return back();
    }

    public function massDestroy(MassDestroyCounterRequest $request)
    {
        $counters = Counter::find(request('ids'));

        foreach ($counters as $counter) {
            $counter->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
