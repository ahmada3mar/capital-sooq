<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public $with = ['plan' , 'industry'];
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('uploaded' , ['disk' => 'public']);
            $data['logo'] =  $path;
        }
        Organization::create($data);
        return \response('success' , 201);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();

        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('uploaded' , ['disk' => 'public']);
            $data['logo'] =  $path;
        }
        $organization->update($data);
        return \response('success' , 200);

    }

}
