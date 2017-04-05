<?php

namespace App\Repositories\Eloquent;

use App\Models\Following;
use App\Repositories\Contracts\FollowingRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Input;

class FollowingRepository extends BaseRepository implements FollowingRepositoryInterface
{
    public function model()
    {
        return Following::class;
    }

    public function selectFollowing($followerId, $followingId)
    {
        return $this->model->where('follower_id', $followerId)->where('following_id', $followingId);
    }
}
