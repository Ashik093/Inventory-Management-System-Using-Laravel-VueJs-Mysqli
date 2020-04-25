<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $fillable = ["order_id","product_id","product_name","product_quantity","product_price","subtotal"];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
