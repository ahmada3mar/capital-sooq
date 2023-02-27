<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $with = ['roles' , 'organization'];


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('uploaded', ['disk' => 'public']);
            $data['avatar'] =  $path;
        }

        $user = User::create($data);
        $user->assignRole($data['role']);
        return \response('success', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('uploaded', ['disk' => 'public']);
            $data['avatar'] =  $path;
        }

        $user->syncRoles($data['role']);
        $user->update($data);
        return \response('success', 200);
    }
}
