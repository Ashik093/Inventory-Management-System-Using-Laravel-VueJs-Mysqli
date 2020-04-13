<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;

class ExpenseController extends Controller
{
   
    public function index()
    {
        return response()->json(Expense::orderBy('id','DESC')->get());   
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'detail'=>'required',
            'amount'=>'required|numeric',
        ]);

        $day = date('d/m/Y');
        $month = date('m/Y');
        $year = date('Y');

        $expense = new Expense;

        $expense->detail = $request->detail;
        $expense->amount = $request->amount;
        $expense->day = $day;
        $expense->month = $month;
        $expense->year = $year;

        $expense->save();

    }

    public function show($id)
    {
        return response()->json(Expense::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'detail'=>'required',
            'amount'=>'required|numeric',
        ]);
        $expense = Expense::find($id);

        $expense->detail = $request->detail;
        $expense->amount = $request->amount;

        $expense->save();
    }

    public function destroy($id)
    {
        Expense::find($id)->delete();
    }

    //additional
    public function dailyExpense(){
        $day = date('d/m/Y');
        return response()->json(Expense::where('day',$day)->orderBy('id','DESC')->get());
    }

    public function monthlyExpense(){
        $month = date('m/Y');
        return response()->json(Expense::where('month',$month)->orderBy('id','DESC')->get());
    }
}
