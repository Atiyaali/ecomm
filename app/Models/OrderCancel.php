<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class OrderCancel extends Model
{
    protected $fillable = ['id','order_id','cancellation_reason','cancelled_by'];

    public function Order(){
        return $this->belongsTo(Order::class);
    }
    public function User(){
        return $this->belongsTo(User::class,'cancelled_by');
    }

}
