<?php

namespace App\Http\Requests;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OrganizationRequest extends FormRequest
{

    public function prepareForValidation()
    {

        if(!$this->name) return throw  ValidationException::withMessages(['name' => 'name field is required']);
        $this->merge([
            'primary_domain' => Organization::primaryDomain($this->name),
            'expired_at' => Carbon::now()->addMonth()->addDay(),
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
            'name' => 'required|string|unique:organizations,name,' . $this->id,
            'email' => 'required|string|email',
            'domain' => 'nullable|string|unique:organizations,domain,' . $this->id,
            'primary_domain' => 'required|string|unique:organizations,primary_domain,' . $this->id,
            'address' => 'required|string',
            'longitude' => 'nullable|string',
            'latitude' => 'nullable|string',
            'logo' => 'nullable|file|max:5000',
            'currency' => 'required|string|in:JOD',
            'industry_id' => 'required|exists:industries,id',
            'expired_at' => 'required|after:yesterday',
            'plan_id' => [
                'required',
                Rule::exists('plans', 'id')
                ->where('active', true)
            ],
        ];
    }
}
