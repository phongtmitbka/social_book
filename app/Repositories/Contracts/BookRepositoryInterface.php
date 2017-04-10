<?php

namespace App\Repositories\Contracts;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function deleteAll(array $ids);

    public function bookTop();
}
