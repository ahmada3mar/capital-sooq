<?php

namespace App\Http\Controllers\Admin;

use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required']);
        Industry::create($data);
        return \response('success' , 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Industry  $industry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Industry $industry)
    {
        $data = $request->validate(['name' => 'required']);
        $industry->update($data);
        return \response('success' , 200);
    }

    public function allIndustries()
    {
        \abort_unless(auth()->user()->hasPermissionTo('view industries') , 403);
        return Industry::all();
    }

}
