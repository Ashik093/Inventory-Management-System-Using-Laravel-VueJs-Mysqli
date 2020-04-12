<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;

class ExpenseController extends Controller
{
   
    public function index()
    {
        
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
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
