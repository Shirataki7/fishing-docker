<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sex',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fish_records()
    {
        return $this->hasMany(FishRecord::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'friend_id', 'id');
    }

    public function notice_friends()
    {
        return $this->hasMany(NoticeFriendAction::class);
    }

    public function notice_posts()
    {
        return $this->hasMany(NoticePostAction::class);
    }

    public function twitter_account()
    {
        return $this->hasOne(twitter_account::class);
    }
}
