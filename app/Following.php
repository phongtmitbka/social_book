<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $table = 'followings';

    public function follower()
    {
    	return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function following()
    {
    	return $this->belongsTo(User::class, 'following_id', 'id');
    }
}
