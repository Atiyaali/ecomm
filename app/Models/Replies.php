<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Replies extends Model
{
    protected $fillable = ['id','contact_id' ,'subject', 'message'];

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
