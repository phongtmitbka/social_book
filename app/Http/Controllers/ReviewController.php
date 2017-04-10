<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Models\Review;


class ReviewController extends Controller
{
    protected  $reviewRepository;
    protected  $userRepository;
    protected  $bookRepository;
    protected $followingRepository;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        UserRepositoryInterface $userRepository,
        BookRepositoryInterface $bookRepository,
        FollowingRepositoryInterface $followingRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->reviewRepository = $reviewRepository;
        $this->bookRepository = $bookRepository;
        $this->followingRepository = $followingRepository;
    }

    public function createReview($bookId)
    {
        $book = $this->bookRepository->find($bookId);
        $followers = $this->followingRepository->newReview($this->user->id);
        $followers->each(function (&$follower) {
            $follower->new_reviews++;
            $follower->save();
        });

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
            'stream_link' => $request->link,
            'location' => $request->location,
        ]);

        if ($request->link) {
            return redirect()->route('video', $review->id);
        } else {
            return redirect()->route('review.show', $review->id);
        }
    }

    public function show($id)
    {
        $user = $this->user;
        $review = $this->reviewRepository->find($id);
        $review = $this->likeOrUnlike($user, $review);

        $reviewAuthors = $this->reviewRepository->selectReviewAuthors($review->user_id)->get();
        $reviewBooks = $this->reviewRepository->selectReviewBooks($review->book->id)->get();
        $reviewTops = $this->reviewRepository->selectReviewTops()->get();

        return view('pages.review-detail', compact('review', 'user', 'reviewAuthors', 'reviewBooks', 'reviewTops'));
    }

    public function showVideo($id)
    {
        $user = $this->user;
        $review = $this->reviewRepository->find($id);
        $review = $this->likeOrUnlike($user, $review);
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
        $review->stream_link = $request->link;
        $review->save();

        if ($request->link) {
            return redirect()->route('video', $review->id);
        } else {
            return redirect()->route('review.show', $review->id);
        }
    }

    public function destroy($id)
    {
        $review = $this->reviewRepository->find($id);
        $review->delete();

        return redirect('home');
    }
}
