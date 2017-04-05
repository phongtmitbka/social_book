<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserBookRepositoryInterface;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    protected $likeRepository;
    protected $commentRepository;
    protected $reviewRepository;

    public function __construct(
        LikeRepositoryInterface $likeRepository,
        CommentRepositoryInterface $commentRepository,
        ReviewRepositoryInterface $reviewRepository
    )
    {
        parent::__construct();
        $this->commentRepository = $commentRepository;
        $this->likeRepository = $likeRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function comment(Request $request)
    {
        $user = $this->user;
        $review = $this->reviewRepository->find($request->reviewId);

        $this->commentRepository->create([
            'user_id' => $user->id,
            'review_id' => $request->reviewId,
            'content' => $request->commentContent,
        ]); 

        return view('layouts.action-item', compact('review', 'user'));
    }

    public function delComment($id)
    {
        $comment = $this->commentRepository->findOrFail($id);
        $review = $comment->review;
        $user = $this->user;

        if (isset($comment)) {
            $comment->delete();
        }

        return view('layouts.action-item', compact('review', 'user'));
    }

    public function editComment(Request $request, $id)
    {
        $user = $this->user;
        $comment = $this->commentRepository->findOrFail($id);
        $review = $comment->review;

        try {
            $comment->content = $request->content;
            $comment->save();

            return view('layouts.action-item', compact('review', 'user'));
        } catch (Exception $e) {
            return view('layouts.action-item', compact('review', 'user'));
        }
    }

    public function like(Request $request)
    {
        $user = $this->user;

        $this->likeRepository->create([
            'user_id' => $user->id,
            'review_id' => $request->reviewId,
        ]);
        
        $review =  $this->reviewRepository->find($request->reviewId);
        $review['user_like'] = 1;

        return view('layouts.action-like', compact('review', 'user'));
    }

    public function unLike(Request $request)
    {
        $user = $this->user;
        $like =  $this->likeRepository->findLike($request->reviewId, $user->id)->first();

        if (isset($like)) {
            $like->delete();
        }

        $review = $this->reviewRepository->find($request->reviewId);
        $review['user_like'] = 0;

        return view('layouts.action-like', compact('review', 'user'));
    }
}
