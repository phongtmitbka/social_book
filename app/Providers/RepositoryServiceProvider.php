<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\RequestBookRepository;
use App\Repositories\Eloquent\ReviewRepository;
use App\Repositories\Eloquent\LikeRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\FollowingRepository;
use App\Repositories\Eloquent\UserBookRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\RequestBookRepositoryInterface;
use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Repositories\Contracts\UserBookRepositoryInterface;
use App;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(BookRepositoryInterface::class, BookRepository::class);
        App::bind(RequestBookRepositoryInterface::class, RequestBookRepository::class);
        App::bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        App::bind(LikeRepositoryInterface::class, LikeRepository::class);
        App::bind(CommentRepositoryInterface::class, CommentRepository::class);
        App::bind(FollowingRepositoryInterface::class, FollowingRepository::class);
        App::bind(UserBookRepositoryInterface::class, UserBookRepository::class);
    }
}
