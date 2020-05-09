<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticePostAction extends Model
{
    protected $table = 'notice_post_actions';

    public function user(){
        return $this->belongsTo(User::class);

    }
    public function fish_record(){
        return $this->belongsTo(FishRecord::class);

    }
}
