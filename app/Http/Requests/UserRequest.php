<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function prepareForValidation()
    {

        $this->merge([
            'organization_id' => $this->user()->isStaffMember() ? $this->organization_id : $this->user()->organization_id,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $this->id,
            'mobile' => 'required|numeric',
            'organization_id' => 'nullable',
            'role' =>[
                'required',
                Rule::exists('roles' , 'name')->whereIn('visible' , $this->user()->isStaffMember() ? [true , false] : [true]),
            ]
        ];
    }
}
