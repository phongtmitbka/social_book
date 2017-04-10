<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->user = Auth::user();

                try {
                    App::setLocale($this->user->language);
                } catch (Exception $e) {
                    App::setLocale('en');
                    
                    return redirect()->back();
                }
            }

            return $next($request);
        });
    }

    public function userLike($user, $reviews)
    {
        if ($user) {
            $reviews = $reviews->each(function (&$review) use ($user) {
                if ($review->userLike($user->id)->count() > 0) {
                    $review['user_like'] = 1;
                } else {
                    $review['user_like'] = 0;
                }
            });
        }

        return $reviews;
    }

    public function likeOrUnlike($user, $review)
    {
        if ($user && $review->userLike($user->id)->count() > 0) {
            $review['user_like'] = 1;
        } else {
            $review['user_like'] = 0;
        }

        return $review;
    }
}
