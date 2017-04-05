<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Models\Review;

class ReviewController extends Controller
{
    protected  $reviewRepository;
    protected  $userRepository;
    protected  $bookRepository;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        UserRepositoryInterface $userRepository,
        BookRepositoryInterface $bookRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->reviewRepository = $reviewRepository;
        $this->bookRepository = $bookRepository;
    }

    public function createReview($bookId)
    {
        $book = $this->bookRepository->find($bookId);

        return view('pages.review', compact('book'));
    }

    public function store(ReviewRequest $request)
    {
        $user = $this->user;

        $review = $this->reviewRepository->create([
            'user_id' => $user->id,
            'book_id' => $request->bookId,
            'caption' => $request->caption,
            'content' => $request->content,
            'location' => $request->location,
        ]); 

        return redirect()->route('review.show', $review->id);
    }

    public function show($id)
    {
        $user = $this->user;
        $review = $this->reviewRepository->find($id);

        if ($user && $this->reviewRepository->userLike($user->id)->count() > 0) {
            $review['user_like'] = 1;
        } else {
            $review['user_like'] = 0;
        }

        $reviewAuthors = $this->reviewRepository->selectReviewAuthors($review->user_id)->get();
        $reviewBooks = $this->reviewRepository->selectReviewBooks($review->book->id)->get();
        $reviewTops = $this->reviewRepository->selectReviewTops()->get();

        return view('pages.review-detail', compact('review', 'user', 'reviewAuthors', 'reviewBooks', 'reviewTops'));
    }

    public function showVideo($id)
    {
        $user = $this->user;
        $review = $this->reviewRepository->find($id);
        $reviewAuthors = $this->reviewRepository->selectVideoAuthors($review->user_id)->get();
        $reviewBooks = $this->reviewRepository->selectVideoBooks($review->book->id)->get();
        $reviewTops = $this->reviewRepository->selectVideoTops()->get();

        return view('pages.video-detail', compact('review', 'user', 'reviewAuthors', 'reviewBooks', 'reviewTops'));
    }

    public function edit($id)
    {
        $review = $this->reviewRepository->find($id);
        $book = $review->book;

        return view('pages.review-edit', compact('book', 'review'));
    }

    public function update(ReviewRequest $request, $id)
    {
        $review = $this->reviewRepository->find($id);
        $review->caption = $request->caption;
        $review->content = $request->content;
        $review->location = $request->location;
        $review->save();

        return redirect()->route('review.show', $review->id);
    }

    public function destroy($id)
    {
        $review = $this->reviewRepository->find($id);
        $review->delete();

        return redirect('home');
    }
}
