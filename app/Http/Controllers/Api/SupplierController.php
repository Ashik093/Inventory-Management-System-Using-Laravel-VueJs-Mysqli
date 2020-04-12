<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Image;

class SupplierController extends Controller
{
    
    public function index()
    {
        return response()->json(Supplier::all());   
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:suppliers',
            'phone'=>'required|integer',
            'address'=>'required',
            'shop_name'=>'required'
        ]);

        $supplier = new Supplier();

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shop_name = $request->shop_name;

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'upload/suppliers/';
            $img_url = $upload_path.$name;
            $img->save($img_url);

            $supplier->photo = $img_url;
        }else{
            $supplier->photo = 'upload/suppliers/default.png';
        }

        $supplier->save();
    }

    public function show($id)
    {
        return response(Supplier::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|integer',
            'address'=>'required',
            'shop_name'=>'required'
        ]);

        $supplier = Supplier::find($id);

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shop_name = $request->shop_name;

        if ($request->new_photo) {
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'upload/suppliers/';
            $img_url = $upload_path.$name;
            $img->save($img_url);
            if ($supplier->photo != 'upload/suppliers/default.png') {
                unlink($supplier->photo);
            }

            $supplier->photo = $img_url;
        }

        $supplier->save();
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier->photo != 'upload/suppliers/default.png') {
            unlink($supplier->photo);
        }

        $supplier->delete();
    }
}
