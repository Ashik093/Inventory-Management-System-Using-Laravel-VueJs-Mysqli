<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Expense;
use App\Model\Product;

class DashboardController extends Controller
{
    public function todaySell(){
    	$date = date('d/m/Y');
    	return response()->json(Order::where('order_date',$date)->sum('total'));
    }

    public function todayIncome(){
    	$date = date('d/m/Y');
    	return response()->json(Order::where('order_date',$date)->sum('pay'));
    }

    public function todayDue(){
    	$date = date('d/m/Y');
    	return response()->json(Order::where('order_date',$date)->sum('due'));
    }

    public function todayExpense(){
    	$date = date('d/m/Y');
    	return response()->json(Expense::where('day',$date)->sum('amount'));
    }

    public function stockOut(){
    	return response()->json(Product::where('quantity','<',1)->get());
    }
}
