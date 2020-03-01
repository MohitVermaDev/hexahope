<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::Class);
    }
    public function paid(){
        return $this->belongsTo(User::Class,'pay_user_id','id');
    }
}
