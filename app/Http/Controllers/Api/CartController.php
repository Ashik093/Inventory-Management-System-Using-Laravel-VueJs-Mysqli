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

        $check = Cart::where('product_id',$id)->first();
        if ($check) {
            Cart::where('product_id',$id)->increment('product_quantity');
            $cart = Cart::where('product_id',$id)->first();
            $sub_total = $cart->product_quantity*$cart->product_price;
            Cart::where('product_id',$id)->update(['sub_total'=>$sub_total]);

        }else{
            $cart = new Cart();
            $cart->product_id = $product->id;
            $cart->product_name = $product->name;
            $cart->product_quantity = 1;
            $cart->product_price = $product->selling_price;
            $cart->sub_total = $product->selling_price;
            $cart->save();
        }

    }

    public function getAll(){
    	return response()->json(Cart::all());
    }

    public function removeCartItem($id){
    	Cart::find($id)->delete();
    }

    public function increment($id){
        Cart::where('id',$id)->increment('product_quantity');
        $cart = Cart::find($id);
        $sub_total = $cart->product_quantity*$cart->product_price;
        Cart::where('id',$id)->update(['sub_total'=>$sub_total]);
    }

    public function decrement($id){
        Cart::where('id',$id)->decrement('product_quantity');
        $cart = Cart::find($id);
        $sub_total = $cart->product_quantity*$cart->product_price;
        Cart::where('id',$id)->update(['sub_total'=>$sub_total]);
    }
}
