<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return Review::class;
    }

    /**
     * Create Comment For Review
     *
     * @param  array $input
     * @return bool
     */
    public function createComment($input)
    {
        if (!auth()->check()) {
            return false;
        }

        $data = [
            'user_id' => auth()->id,
            'content' => $input['content'],
        ];

        return $this->model->find($input['review_id'])->comments()->create($data);
    }

    public function selectStreamVideo($userId)
    {
        return $this->model->where('stream_link', '<>', null)->where('user_id', $userId);
    }

    public function selectAllVideo()
    {
        return $this->model->where('stream_link', '<>', null);
    }

    public function selectReviewText($userId)
    {
        return $this->model->where('stream_link', null)->where('user_id', $userId)->orderBy('id', 'desc');
    }

    public function selectAllReview()
    {
        return $this->model->where('stream_link', null)->orderBy('id', 'desc');;
    }

    public function selectReviewAuthors($userId)
    {
        return $this->model->where('stream_link', null)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(config('view.top_select'));
    }

    public function selectReviewBooks($bookId)
    {
        return $this->model->where('stream_link', null)
            ->where('book_id', $bookId)
            ->orderBy('created_at', 'desc')
            ->limit(config('view.top_select'));
    }

    public function selectReviewTops()
    {
        return $this->model->where('stream_link', null)
            ->orderBy('created_at', 'desc')
            ->limit(config('view.top_select'));
    }

    public function selectVideoAuthors($userId)
    {
        return $this->model->where('stream_link', '<>', null)
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->limit(config('view.top_select'));
    }

    public function selectVideoBooks($bookId)
    {
        return $this->model->where('stream_link', '<>', null)
            ->where('book_id', $bookId)
            ->orderBy('id', 'desc')
            ->limit(config('view.top_select'));
    }

    public function selectVideoTops()
    {
        return $this->model->where('stream_link', '<>', null)
            ->orderBy('id', 'desc')
            ->limit(config('view.top_select'));
    }

    public function getTopVideo()
    {
        return $this->model->where('stream_link', '<>', null)
            ->orderBy('id', 'desc')
            ->take(config('view.top_video'));
    }

    public function mostNewVideo()
    {
        return $this->model->where('stream_link',  '<>', null)
            ->take(config('view.most_new_review'))
            ->first();
    }

    public function searchReview($caption)
    {
        return $this->model->where('caption', 'like', '%' . $caption . '%')->where('stream_link', null);
    }

    public function searchVideo($caption)
    {
        return $this->model->where('caption', 'like', '%' . $caption . '%')->where('stream_link',  '<>', null);
    }

    public function userLike($userId)
    {
        return $this->model->userLike($userId);
    }

    public function reviewTop()
    {
        return $this->model->where('stream_link', null)->get();
    }

    public function videoTop()
    {
        return $this->model->where('stream_link',  '<>', null)->get();
    }
}
