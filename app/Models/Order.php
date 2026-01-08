<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id','user_id','order_number','order_status','payment_method','payment_status','subtotal','shipping_fee','total','shipping_address'];
protected $casts = [
    'shipping_address' => 'array',
];
   public function User(){
    return $this->belongsTo(User::class);
   }

    public function OrderItem(){
        return $this->hasMany(OrderItems::class);
    }

    public function OrderCancel(){
        return $this->hasOne(OrderCancel::class);
    }
}


