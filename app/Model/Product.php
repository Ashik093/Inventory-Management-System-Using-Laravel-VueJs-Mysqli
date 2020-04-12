<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','code','root','buying_price','selling_price','supplier_id','buying_date','quantity','picture'];

    public function category(){
    	return $this->belongsTo(Category::class);
    }
    public function supplier(){
    	return $this->belongsTo(Supplier::class);
    }
}
