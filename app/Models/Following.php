<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $fillable = [
        'follower_id',
        'following_id',
        'new_reviews',
    ];

    protected $table = 'followings';

    public function follower()
    {
    	return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function following()
    {
    	return $this->belongsTo(User::class, 'following_id', 'id');
    }

    public function resetNewReview()
    {
        $this->new_reviews = 0;
        $this->save();
    }
}
