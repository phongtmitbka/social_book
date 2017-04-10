<?php

namespace App\Repositories\Eloquent;

use App\Models\UserBook;
use App\Repositories\Contracts\UserBookRepositoryInterface;

class UserBookRepository extends BaseRepository implements UserBookRepositoryInterface
{
    public function model()
    {
        return UserBook::class;
    }

    public function favorites($userId)
    {
        return $this->model->where('user_id', $userId)->where('favorite', 1);
    }

    public function bookFavorites($bookId)
    {
    	return $this->model->where('book_id', $bookId)->where('favorite', 1)->count();
    }
}
