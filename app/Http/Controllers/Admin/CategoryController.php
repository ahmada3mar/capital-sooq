<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('uploaded' , ['disk' => 'public']);
            $data['image'] =  $path;
        }
        Category::create($data);
        return \response('success' , 201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            $path = $request->file('image')->store('uploaded' , ['disk' => 'public']);
            $data['image'] =  $path;
        }
        $category->update($data);
        return \response('success' , 200);
    }


}
