<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Image;

class ProductController extends Controller
{
    
    public function index()
    {
        return response()->json(Product::with('category','supplier')->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'=>'required',
            'name'=>'required|unique:products',
            'code'=>'required',
            'root'=>'required',
            'buying_price'=>'required|numeric',
            'selling_price'=>'required|numeric',
            'supplier_id'=>'required',
            'buying_date'=>'required',
            'quantity'=>'required|integer'
        ]);

        $product = new Product();

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->buying_date = $request->buying_date;
        $product->quantity = $request->quantity;

        if ($request->picture) {
            $position = strpos($request->picture, ';');
            $sub = substr($request->picture, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->picture)->resize(240,200);
            $upload_path = 'upload/products/';
            $img_url = $upload_path.$name;
            $img->save($img_url);

            $product->picture = $img_url;
        }else{
            $product->picture = 'upload/products/default.png';
        }

        $product->save();
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id'=>'required',
            'name'=>'required',
            'code'=>'required',
            'root'=>'required',
            'buying_price'=>'required|numeric',
            'selling_price'=>'required|numeric',
            'supplier_id'=>'required',
            'buying_date'=>'required',
            'quantity'=>'required|integer'
        ]);

        $product = Product::find($id);

        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->supplier_id = $request->supplier_id;
        $product->buying_date = $request->buying_date;
        $product->quantity = $request->quantity;

        if ($request->new_picture) {
            $position = strpos($request->new_picture, ';');
            $sub = substr($request->new_picture, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->new_picture)->resize(240,200);
            $upload_path = 'upload/products/';
            $img_url = $upload_path.$name;
            $img->save($img_url);
            if ($product->picture != 'upload/product/default.png') {
                unlink($product->picture);
            }

            $product->picture = $img_url;
        }

        $product->save();
        
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->picture != 'upload/products/default.png') {
            unlink($product->picture);
        }
        $product->delete();
    }
}
