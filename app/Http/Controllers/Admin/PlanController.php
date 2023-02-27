<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        $data = $request->validated();
        Plan::create($data);
        return response('success', 201);
    }

    /**
     * update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request , Plan $plan)
    {
        $data = $request->validated();
        $plan->update($data);
        return response('success', 200);
    }

    public function search(&$query, $request)
    {
        if ($request->name != '') {
            $query->where('name', 'like', '%' . static::escape_like($request->name) . '%');
        }

        if ($request->active != '') {
            $query->whereActive($request->active);
        }
    }


    public function allPlans()
    {
        \abort_unless(auth()->user()->hasPermissionTo('view plans') , 403);
        return Plan::whereActive(true)->get();
    }

}
