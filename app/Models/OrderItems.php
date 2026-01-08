<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $fillable = ['id','order_id','product_id','quantity'];


    public function Order(){
        return $this->belongsTo(Order::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}

