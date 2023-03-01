<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name,' . ($this->role->id ?? 'except,id'),
            'permissions_ids' => 'required|array|min:1',
            'permissions_ids.*' => 'required|integer|exists:permissions,id',
        ];
    }
}
