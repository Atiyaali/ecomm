<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['id','name','phone','email','message'];

    public function replies(){
        return $this->hasMany(Replies::class);
    }
}
