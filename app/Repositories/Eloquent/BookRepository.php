<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\BookRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\Book;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    public function model()
    {
        return Book::class;
    }

    /**
     * Get All Book Paginate
     *
     * @return pagination
     */
    public function getAllBookPaginate()
    {
        return $this->model->with('author')->paginate();
    }

    /**
     * Register book
     *
     * @param  array $request
     *
     * @return mixed
     */
    public function create(array $request)
    {
        if (!$this->model->create($this->dataRequest($request))) {
            return false;
        }

        return true;
    }

    /**
     * Update a book
     *
     * @param  array $request
     * @param  int $id
     *
     * @return bool
     */
    public function update(array $request, $id, $withSoftDeletes = false)
    {
        if ($this->model->find($id)->update($this->dataRequest($request, $id))) {
            return true;
        }

        return false;
    }

    /**
     * Delete list books
     *
     * @param  array $ids
     *
     * @return bool
     */
    public function deleteAll(array $ids)
    {
        if (!$ids) {
            return false;
        }

        $this->model->whereIn('id', $ids)->get()->each(function ($book) {
            $book->delete();
        });

        return true;
    }

    /**
     * @return 15 latest books
     */
    public function findLatest()
    {
      return $this->model->orderBy('publish_date', 'desc')->limit(config('settings.book.limit'))->get();
    }

    public function bookTop()
    {
        return $this->model->limit(10);
    }
}
