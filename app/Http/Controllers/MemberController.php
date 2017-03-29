<?php

namespace App\Http\Controllers;

use App\User;
use App\UserBook;
use App\Review;
use App\Following;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function searchMember(Request $request)
    {
        $members = User::searchMember($request->name)->get();

        return view('pages.search-member', compact('members'));
    }

    public function show($id)
    {
        if (isset($this->user->id) && ($this->user->id != $id)) {
            $following = Following::selectFollower($this->user->id)->selectFollowing($id)->first();

            if (isset($following)) {
                $following->resetNewReview();
            }
        }
        
        $this->shareView($id);

        return view('profiles.timeline');
    }

    public function showVideo($id)
    {
        $this->shareView($id);

        return view('profiles.videos');
    }

    public function following($id)
    {
        $this->shareView($id);

        return view('profiles.followings');
    }

    public function about($id)
    {
        $this->shareView($id);

        return view('profiles.about');
    }

    public function favorites($id)
    {
        $this->shareView($id);
        $favorites = UserBook::selectUser($id)->favorites()->paginate(config('view.paginate'));

        return view('profiles.favorites', compact('favorites'));
    }

    public function shareView($id)
    {
        $videos = Review::selectUser($id)->selectStreamVideo()->get();
        $numberVideos = $videos->count();
        $numberFavorites = UserBook::selectUser($id)->favorites()->count();
        $member = User::find($id);
        $user = $this->user;
        $reviews = Review::selectUser($id)->selectReviewText()->get();
        $reviews = $this->user_like($user, $reviews);
        
        view()->share('user', $this->user);
        view()->share('member', $member);
        view()->share('videos', $videos);
        view()->share('numberVideos', $numberVideos);
        view()->share('numberFavorites', $numberFavorites);
        view()->share('reviews', $reviews);
    }
}
