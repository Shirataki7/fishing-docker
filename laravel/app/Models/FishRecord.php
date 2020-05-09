<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishRecord extends Model
{
    //テーブルの指定
    protected $table = 'fish_records';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
