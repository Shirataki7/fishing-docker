<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'friend_id','id');
    }

    public function fish_records(){
        return $this->hasMany(FishRecord::class, 'user_id', 'friend_id');
    }

}
