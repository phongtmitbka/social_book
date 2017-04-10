<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function isExistEmail($email);

    public function searchUser($item);

    public function deleteAll($users);

    public function confirmation($tokenConfirm);

    public function findUser($facebookId);

    public function searchMember($name);

    public function confirmed();

    public function userTop();
}
