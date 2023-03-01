<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function prepareForValidation()
    {

        $this->merge([
           'attributes' => $this->get('attributes') ? json_decode($this->get('attributes') , true) : null ,
           'organization_id' =>  $this->user()->isStaffMember() ? $this->organization_id : $this->user()->organization_id,
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
            'active' => 'boolean',
            'digital' => 'boolean',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'organization_id' => 'required|exists:organizations,id',
            'cost' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'stock' => 'required_unless:digital,1|numeric|integer|min:0',
            'description' => 'required',
            'gallery' => 'array|nullable',
            'gallery.*' => 'file|max:5000',
            'attributes' => 'array|nullable',
            'attributes.*.name' => 'required|string',
            'attributes.*.values' => 'required|array|min:1',
            'attributes.*.values.*.name' => 'required|string',
            'attributes.*.values.*.stock' => 'nullable|numeric|integer|min:0',
            'deletedGalleries' => 'array|nullable',
            'deletedGalleries.*' => [
                'numeric',
                Rule::exists('galleries','id')->where('product_id' , $this->id)
            ],
            'updatedGalleries' => 'array|nullable',
            'updatedGalleries.*.id' => [
                'numeric',
                'required',
                Rule::exists('galleries','id')->where('product_id' , $this->id)
            ],
            'updatedGalleries.*.file' => 'required|file|max:5000',
            'newGalleries' => 'array|nullable',
            'newGalleries.*.file' => 'file|max:5000',
        ];
    }
}
