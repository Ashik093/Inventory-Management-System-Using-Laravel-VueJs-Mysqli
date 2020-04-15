<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use Image;

class CustomerController extends Controller
{

    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'phone'=>'required|numeric',
            'address'=>'required',
        ]);

        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'upload/customers/';
            $img_url = $upload_path.$name;
            $img->save($img_url);

            $customer->photo = $img_url;
        }else{
            $customer->photo = 'upload/customers/default.png';
        }

        $customer->save();
    }

    
    public function show($id)
    {
        return response()->json(customer::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'address'=>'required',
        ]);

        $customer = Customer::find($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        if ($request->new_photo) {
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'upload/customers/';
            $img_url = $upload_path.$name;
            $img->save($img_url);
            if ($customer->photo != 'upload/customers/default.png') {
                unlink($customer->photo);
            }

            $customer->photo = $img_url;
        }

        $customer->save();
    }

    
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if ($customer->photo != 'upload/customers/default.png') {
            unlink($customer->photo);
        }

        $customer->delete();
    }
}
