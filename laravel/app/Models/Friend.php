<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'friend_id','id');
    }

//フレンド登録した相手のid(friend_id)をfish_recordsのuser_idに紐づけて釣り記録を取得
    public function fish_records(){
        return $this->hasMany(FishRecord::class, 'user_id', 'friend_id');
    }

}
