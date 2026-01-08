<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
 'name','category_id','description','price','quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function CartItem(){
        return $this->hasMany(CartItem::class);
    }
   public function OrderItem(){
    return $this->hasMany(OrderItems::class);
   }

}
