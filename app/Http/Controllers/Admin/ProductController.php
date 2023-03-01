<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{

    protected $with=['image' , 'category' , 'organization' , 'attributes' , 'galleries'];

    public function store(ProductRequest $request)
    {

        $request_data = $request->validated();
        $data = [
            'name' => $request_data['name'] ,
            'active' => $request_data['active'] ?? '0',
            'digital' => $request_data['digital'] ?? '0',
            'category_id' => $request_data['category_id'],
            'organization_id' => $request_data['organization_id'],
            'cost' => $request_data['cost'] ?? 0,
            'price' => $request_data['price'] ?? 0,
            'stock' => $request_data['stock'] ?? 0 ,
            'description' => $request_data['description'],
        ];

        $product = Product::create($data);

        $attributes = $request_data['attributes'];
        foreach($attributes as $attribute){
           $product_attribute = $product->attributes()->create(['name'=>$attribute['name']]);
           $product_attribute->values()->createMany($attribute['values']);
        }

        $galleries = [];
        foreach($request_data['gallery'] as $gallery){
            $galleries[] = ['image' => $gallery->store('uploaded', ['disk' => 'public'])];
        }
        $product->galleries()->createMany($galleries);

    }

    public function update(ProductRequest $request , Product $product)
    {


        $request_data = $request->validated();

        $data = [
            'name' => $request_data['name'] ,
            'active' => $request_data['active'] ?? '0',
            'digital' => $request_data['digital'] ?? '0',
            'category_id' => $request_data['category_id'],
            'organization_id' => $request_data['organization_id'],
            'cost' => $request_data['cost'] ?? 0,
            'price' => $request_data['price'] ?? 0,
            'stock' => $request_data['stock'] ?? 0 ,
            'description' => $request_data['description'],
        ];

        $product->update($data);

        $attributes = $request_data['attributes'];
        $product->attributes()->delete();
        foreach($attributes as $attribute){
           $product_attribute = $product->attributes()->create(['name'=>$attribute['name']]);
           $product_attribute->values()->createMany($attribute['values']);
        }

        $galleries = [];
        foreach($request_data['newGalleries'] ?? [] as $gallery){
            $galleries[] = ['product_id'=>$product->id ,'id' => null ,'image' => $gallery->store('uploaded', ['disk' => 'public'])];
        }

        foreach($request_data['updatedGalleries'] ?? [] as $gallery){
            $galleries[] = ['product_id'=>$product->id ,'id'=> $gallery['id'], 'image' => $gallery['file']->store('uploaded', ['disk' => 'public'])];
        }

        $product->galleries()->upsert($galleries, ['id']  , ['image']);
        $product->galleries()->whereIn('id' , $request_data['deletedGalleries'])->delete();

    }

}
