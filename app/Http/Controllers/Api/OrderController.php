<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function orderDone(Request $request){
    	$validatedData = $request->validate([
    		'customer_id'=>'required',
    		'pay'=>'required',
    		'payby'=>'required'
    	]);

    	$data = array();
    	$data['customer_id']=$request->customer_id;
    	$data['quantity']=$request->quantity;
    	$data['subtotal']=$request->subtotal;
    	$data['vat']=$request->vat;
    	$data['total']=$request->total;
    	$data['pay']=$request->pay;
    	$data['due']=$request->due;
    	$data['payby']=$request->payby;
    	$data['order_date']=date('d/m/Y');
    	$data['order_month']=date('F');
    	$data['order_year']=date('Y');

    	$orderid = DB::table("orders")->insertGetId($data);
    	$contents = DB::table("carts")->get();

    	$odata = array();

    	foreach ($contents as $content) {
	    	$odata['order_id']=$orderid;
	    	$odata['product_id']=$content->product_id;
	    	$odata['product_name']=$content->product_name;
	    	$odata['product_quantity']=$content->product_quantity;
	    	$odata['product_price']=$content->product_price;
	    	$odata['subtotal']=$content->sub_total;

	    	DB::table('orderdetails')->insert($odata);

	    	DB::table('products')->where('id',$content->product_id)->update(['quantity'=>DB::raw('quantity-'.$content->product_quantity)]);
    	}

    	DB::table('carts')->delete();

    }
}
