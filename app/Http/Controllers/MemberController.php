<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Repositories\Contracts\UserBookRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $userRepository;
    protected $followingRepository;
    protected $userBookRepository;
    protected  $reviewRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FollowingRepositoryInterface $followingRepository,
        UserBookRepositoryInterface $userBookRepository,
        ReviewRepositoryInterface $reviewRepository
    )
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->followingRepository = $followingRepository;
        $this->userBookRepository = $userBookRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function searchMember(Request $request)
    {
        $members = $this->userRepository->searchMember($request->name)->get();

        return view('pages.search-member', compact('members'));
    }

    public function show($id)
    {
        if (isset($this->user->id) && ($this->user->id != $id)) {
            $following = $this->followingRepository->selectFollowing($this->user->id, $id)->first();

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
        $favorites = $this->userBookRepository->favorites($id)->paginate(config('view.paginate'));

        return view('profiles.favorites', compact('favorites'));
    }

    public function follow($id)
    {
        $user = $this->user;
        $member = $this->userRepository->find($id);

        $this->followingRepository->create([
            'follower_id' => $user->id,
            'following_id' => $id,
        ]);
        
        $member['following'] = 1;

        return view('layouts.follow', compact('member', 'user'));
    }

    public function unFollow($id)
    {
        $user = $this->user;
        $member = $this->userRepository->find($id);
        $following =  $this->followingRepository->selectFollowing($user->id, $member->id)->first();

        if (isset($following)) {
            $following->delete();
            $member['following'] = 0;
        }

        return view('layouts.follow', compact('member', 'user'));
    }

    public function shareView($id)
    {
        $user = $this->user;
        $videos = $this->reviewRepository->selectStreamVideo($id)->get();
        $numberVideos = $videos->count();
        $numberFavorites = $this->userBookRepository->favorites($id)->count();
        $member = $this->userRepository->find($id);
        
        if ($user && $this->followingRepository->selectFollowing($user->id, $member->id)->count() > 0) {
            $member['following'] = 1;
        } else {
            $member['following'] = 0;
        }

        $reviews = $this->reviewRepository->selectReviewText($id)->get();
        $reviews = $this->userLike($user, $reviews);

        view()->share('user', $this->user);
        view()->share('member', $member);
        view()->share('videos', $videos);
        view()->share('numberVideos', $numberVideos);
        view()->share('numberFavorites', $numberFavorites);
        view()->share('reviews', $reviews);
    }
}
