<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
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

    public function scopeSelectUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeSelectStreamVideo($query)
    {
        return $query->where('stream_link', '<>', null);
    }

    public function scopeSelectReviewText($query)
    {
        return $query->where('stream_link', null);
    }

    public function scopeSortDesc($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeSelectTop($query)
    {
        return $query->take(config('view.top_video'));
    }

    public function scopeMostNewVideo($query)
    {
        return $query->take(config('view.most_new_review'));
    }

    public function scopeSearchReview($query, $caption)
    {
        return $query->where('caption', 'like', '%' . $caption . '%');
    }

    public function scopeUserLike($query, $userId)
    {
        return $this->likes->where('user_id', $userId);
    }
}
