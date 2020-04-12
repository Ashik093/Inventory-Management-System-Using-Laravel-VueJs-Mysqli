<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Image;
use App\Model\Category;

class CategoryController extends Controller
{
   
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|unique:categories'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
    }

   
    public function show($id)
    {
        return response()->json(Category::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'=>'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}
