<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Salary;

class SalaryController extends Controller
{
	public function index(){
		return response()->json(DB::table('salaries')->select('month','year')->groupBy('month','year')->get());
	}

    public function pay(Request $request){
    	$validatedData = $request->validate([
    		'month'=>'required'
    	]);

    	$id = $request->id;
    	$date = date('d/m/Y');
    	$year = date('Y');

    	$check = DB::table('salaries')->where('employee_id',$id)->where('month',$request->month)->where('year',$year)->first();

    	if ($check) {
    		return response()->json('0');
    	}else{
    		$salary = new Salary();

	    	$salary->employee_id = $id;
	    	$salary->amount = $request->salary;
	    	$salary->date = $date;
	    	$salary->month = $request->month;
	    	$salary->year = $year;
	    	$salary->save();
	    	return response()->json('1');
    	}
    }

    public function monthlySalary($month,$year){
    	$salary = Salary::where('month',$month)->where('year',$year)->with('employee')->get();
    	return response()->json($salary);
    }

}
