<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["customer_id","quantity","subtotal","vat","total","pay","due","payby","order_date","order_month","order_year"];
}
