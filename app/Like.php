<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'review_id'];
    
    protected $table = 'likes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function scopeFindLike($query, $reviewId, $userId)
    {
        return $query->where('review_id', $reviewId)->where('user_id', $userId);
    }
}
