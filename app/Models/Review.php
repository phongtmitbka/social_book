<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'stream_link',
        'caption',
        'content',
        'location',
    ];

    protected $table = 'reviews';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function userLike($userId)
    {
        return $this->likes->where('user_id', $userId);
    }
}
