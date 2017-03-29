<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Comment;
use App\Review;

class ActionController extends Controller
{
    public function comment(Request $request)
    {
        $user = $this->user;
        $review = Review::find($request->reviewId);

        Comment::create([
            'user_id' => $user->id,
            'review_id' => $request->reviewId,
            'content' => $request->commentContent,
        ]); 

        return view('layouts.action-item', compact('review', 'user'));
    }

    public function delComment($id)
    {
        $comment = Comment::findOrFail($id);
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
        $comment = Comment::findOrFail($id);
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

        Like::create([
            'user_id' => $user->id,
            'review_id' => $request->reviewId,
        ]);
        
        $review = Review::find($request->reviewId);
        $review['user_like'] = 1;

        return view('layouts.action-like', compact('review', 'user'));
    }

    public function unLike(Request $request)
    {
        $user = $this->user;
        $like = Like::findLike($request->reviewId, $user->id)->first();

        if (isset($like)) {
            $like->delete();
        }

        $review = Review::find($request->reviewId);
        $review['user_like'] = 0;

        return view('layouts.action-like', compact('review', 'user'));
    }
}
