<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate(10); // latest() ordenado pelo created_at;
        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.show', ['plan' => $plan]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlanRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('plans.index');
    }

    public function destroy($url)
    {
        $plan = $this->repository->with('details')
            ->where('url', $url)
            ->first();

        if (!$plan)
            return redirect()->back();

        if($plan->details->count() > 0){
            return redirect()->back()->with('error', 'Existem detalhes vinculados a esse plano, portando não pode ser deletado');
        }

        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', compact('plan'));
    }

    public function update(StoreUpdatePlanRequest $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        $plans  = $this->repository->search($request->get('filter'));
        $filter = $request->except('_token');

        return view('admin.pages.plans.index', [
            'plans'     => $plans,
            'filter'    => $filter
        ]);
    }

}
