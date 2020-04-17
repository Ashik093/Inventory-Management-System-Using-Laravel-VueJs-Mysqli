<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;

class PosController extends Controller
{
    public function getProductById($id){
    	return response()->json(Product::where('category_id',$id)->get());
    }
}
