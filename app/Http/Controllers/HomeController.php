<?php

namespace App\Http\Controllers;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $bookRepository;
    protected $categoryRepository;
    protected  $reviewRepository;

    public function __construct(
        BookRepositoryInterface $bookRepository,
        CategoryRepositoryInterface $categoryRepository,
        ReviewRepositoryInterface $reviewRepository
    )
    {
        parent::__construct();
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $user = $this->user;
        $videos =  $this->reviewRepository->getTopVideo()->get();
        $mostNewVideo = $this->reviewRepository->mostNewVideo();
        $numberVideos = $videos->count();
        $cates = $this->categoryRepository->all();
        $reviews = $this->reviewRepository->selectAllReview()->get();
        $reviews = $this->userLike($user, $reviews);

        return view('pages.home', compact('videos', 'numberVideos', 'mostNewVideo', 'cates', 'reviews', 'user'));
    }

    public function categoryReview(Request $request)
    {
        $books = $this->categoryRepository->find($request->categoryId)->books()->get();
        $user = $this->user;

        return view('pages.category-review', compact('books', 'user'));
    }

    public function fullVideo()
    {
        $videos = $this->reviewRepository->selectAllVideo()->get();

        return view('pages.full-video', compact('videos'));
    }

    public function searchReview(Request $request)
    {
        $reviews = $this->reviewRepository->searchReview($request->caption)->get();

        return view('pages.search-review', compact('reviews'));
    }
}
