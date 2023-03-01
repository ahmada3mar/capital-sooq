<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        $role->givePermissionTo($data['permissions_ids']);
        return \response('success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        return  $role->syncPermissions($data['permissions_ids']);
    }


    public function allRoles()
    {
        abort_unless(auth()->user()->hasPermissionTo('view roles') , 403);
        $roles = Role::query();
        if(!auth()->user()->isStaffMember()){
            $roles->whereVisible(true);
        }
        return $roles->get();
    }
}
