<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Category;
use App\Book;

class HomeController extends Controller
{
    public function index()
    {
        $user = $this->user;
        $streamVideos = Review::selectStreamVideo();
        $videos = $streamVideos->sortDesc()->selectTop()->get();
        $mostNewVideo = $streamVideos->mostNewVideo()->first();
        $numberVideos = $videos->count();
        $cates = Category::all();
        $reviews = Review::selectReviewText()->get();
        $reviews = $this->user_like($user, $reviews);

        return view('pages.home', compact('videos', 'numberVideos', 'mostNewVideo', 'cates', 'reviews', 'user'));
    }

    public function categoryReview(Request $request)
    {
        $books = Book::bookCategory($request->categoryId)->get();
        $user = $this->user;

        return view('pages.category-review', compact('books', 'user'));
    }

    public function fullVideo()
    {
        $videos = Review::selectStreamVideo()->sortDesc()->get();

        return view('pages.full-video', compact('videos'));
    }

    public function searchReview(Request $request)
    {
        $reviews = Review::searchReview($request->caption)->get();

        return view('pages.search-review', compact('reviews'));
    }
}
