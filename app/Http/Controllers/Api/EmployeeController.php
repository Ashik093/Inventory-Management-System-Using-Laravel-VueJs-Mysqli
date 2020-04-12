<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use Image;

class EmployeeController extends Controller
{
    
    public function index()
    {
        return response()->json(Employee::all());
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:employees',
            'phone'=>'required|integer',
            'address'=>'required',
            'salary'=>'required|numeric',
            'joining_date'=>'required'
        ]);

        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;

        if ($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'upload/employees/';
            $img_url = $upload_path.$name;
            $img->save($img_url);

            $employee->photo = $img_url;
        }else{
            $employee->photo = 'upload/employees/default.png';
        }

        $employee->save();

    }

    
    public function show($id)
    {
        return response()->json(Employee::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|integer',
            'address'=>'required',
            'salary'=>'required|numeric',
            'joining_date'=>'required'
        ]);

        $employee = Employee::find($id);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;

        if ($request->new_photo) {
            $position = strpos($request->new_photo, ';');
            $sub = substr($request->new_photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->new_photo)->resize(240,200);
            $upload_path = 'upload/employees/';
            $img_url = $upload_path.$name;
            $img->save($img_url);
            if ($employee->photo != 'upload/employees/default.png') {
                unlink($employee->photo);
            }

            $employee->photo = $img_url;
        }

        $employee->save();
    }

    
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee->photo != 'upload/employees/default.png') {
            unlink($employee->photo);
        }

        $employee->delete();
    }
}
