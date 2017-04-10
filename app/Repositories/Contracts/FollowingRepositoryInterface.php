<?php

namespace App\Repositories\Contracts;

interface FollowingRepositoryInterface extends RepositoryInterface
{
    public function selectFollowing($followerId, $followingId);

    public function newReview($userId);
}
