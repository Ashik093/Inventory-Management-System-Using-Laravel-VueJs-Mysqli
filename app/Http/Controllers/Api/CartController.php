<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Cart;

class CartController extends Controller
{
    public function addToCart($id){
    	$product= Product::findOrFail($id);

    	$cart = new Cart();
    	$cart->product_id = $product->id;
    	$cart->product_name = $product->name;
    	$cart->product_quantity = 1;
    	$cart->product_price = $product->selling_price;
    	$cart->sub_total = $product->selling_price;
    	$cart->save();

    }

    public function getAll(){
    	return response()->json(Cart::all());
    }

    public function removeCartItem($id){
    	Cart::find($id)->delete();
    }
}
