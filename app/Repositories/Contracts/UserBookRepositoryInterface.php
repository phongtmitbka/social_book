<?php

namespace App\Repositories\Contracts;

interface UserBookRepositoryInterface extends RepositoryInterface
{
    public function favorites($userId);
}
