<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Repositories\Contracts\UserBookRepositoryInterface;

class RankTopController extends Controller
{
    protected $reviewRepository;
    protected $userRepository;
    protected $bookRepository;
    protected $followingRepository;
    protected $userBookRepository;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        UserRepositoryInterface $userRepository,
        BookRepositoryInterface $bookRepository,
        FollowingRepositoryInterface $followingRepository,
        UserBookRepositoryInterface $userBookRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->reviewRepository = $reviewRepository;
        $this->bookRepository = $bookRepository;
        $this->followingRepository = $followingRepository;
        $this->userBookRepository = $userBookRepository;
    }

    public function index()
    {
        $user = $this->user;
        $members = $this->rankTopUser();
        $reviews = $this->rankTopReview();
        $videos = $this->rankTopVideo();
        $books = $this->rankTopBook();

        return view('pages.rank-top', compact('members', 'reviews', 'videos', 'books', 'user'));
    }

    public function rankTopUser()
    {
        $user = $this->user;
        $members = $this->userRepository->all();
        $members = $members->each(function ($member) {
            $member['followers'] = $member->followers()->count();
        });
        
        $members = $members->sortByDesc('followers')->take(10);

        if ($user) {
            $members = $members->each(function (&$member) use ($user) {
                if ($user && $this->followingRepository->selectFollowing($user->id, $member->id)->count() > 0) {
                    $member['following'] = 1;
                } else {
                    $member['following'] = 0;
                }
            });
        }

        return $members;
    }

    public function rankTopReview()
    {
        $reviews = $this->reviewRepository->reviewTop();
        $reviews = $reviews->each(function ($review) {
            $review['num_likes'] = $review->likes()->count();
        });

        $reviews = $reviews->sortByDesc('num_likes')->take(10);

        return $reviews;
    }

    public function rankTopVideo()
    {
        $reviews = $this->reviewRepository->videoTop()->take(10);

        return $reviews;
    }

    public function rankTopBook()
    {
        $books = $this->bookRepository->all();
        $books = $books->each(function ($book) {
            $book['favorites'] = $this->userBookRepository->bookFavorites($book->id);
        });

        $books = $books->sortByDesc('favorites')->take(10);

        return $books;
    }
}
