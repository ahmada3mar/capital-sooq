<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'active' => 'nullable|boolean',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
            'users_limit' => 'required|numeric|integer',
            'products_limit' => 'required|numeric|integer',
            'transactions_fees'=> 'required|numeric',
        ];
    }
}
