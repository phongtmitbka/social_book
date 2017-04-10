<?php

namespace App\Repositories\Contracts;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function createComment($input);

    public function selectStreamVideo($userId);

    public function selectAllVideo();

    public function selectReviewText($userId);

    public function selectAllReview();

    public function getTopVideo();

    public function mostNewVideo();

    public function searchReview($caption);

    public function userLike($userId);

    public function reviewTop();

    public function videoTop();
}
