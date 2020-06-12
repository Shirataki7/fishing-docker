<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model
{
    protected $table = 'twitter_accounts';

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
