<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeFriendAction extends Model
{
    protected $table = 'notice_friend_actions';

    public function user(){
        return $this->belongsTo(User::class,'added_friend_id','id');

    }

}
