<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['id','product_id','cart_id' ,'quantity'];

    public function Cart(){
        return $this->belongsTo(Cart::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public static function totalamount($cartId){
        return self::where('cart_id', $cartId)->with('Product')->get()->sum(function($item){
     return $item->Product->price *  $item->quantity;
        });

    }
}
