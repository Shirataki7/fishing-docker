<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //テーブルの指定
    protected $table = 'comments';

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function fish_records(){
        return $this->belongsTo(FishRecord::class);
    }
}
