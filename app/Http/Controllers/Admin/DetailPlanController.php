<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $detailPlanRepository, $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->detailPlanRepository     = $detailPlan;
        $this->plan                     = $plan;
    }

    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', '=', $urlPlan)->first()){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', compact('details', 'plan'));
    }

    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', '=', $urlPlan)->first()){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', compact('plan'));
    }

    public function store(Request $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', '=', $urlPlan)->first()){
            return redirect()->back();
        }

        /*
         * $data               = $request->all();
         * $data['plan_id']    = $plan->id;
         * $this->detailPlanRepository->create($data);
        */

        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $urlPlan);

    }

    public function edit($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', '=', $urlPlan)->first();
        $detail = $this->detailPlanRepository->find($idDetail);

        if(!$plan or !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', compact('plan', 'detail'));
    }

    public function update(StoreUpdateDetailPlanRequest $request, $urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', '=', $urlPlan)->first();
        $detail = $this->detailPlanRepository->find($idDetail);

        if(!$plan or !$detail){
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $urlPlan);
    }

    public function show($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', '=', $urlPlan)->first();
        $detail = $this->detailPlanRepository->find($idDetail);

        if(!$plan or !$detail){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', compact('plan', 'detail'));
    }

    public function destroy($urlPlan, $idDetail)
    {
        $plan   = $this->plan->where('url', '=', $urlPlan)->first();
        $detail = $this->detailPlanRepository->find($idDetail);

        if(!$plan or !$detail){
            return redirect()->back();
        }

        $detail->delete();

        return redirect()->route('details.plan.index', $urlPlan)->with('message', 'Registro deletado com sucesso');
    }

}
