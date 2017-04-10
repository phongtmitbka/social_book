<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    /**
     * Check email exist
     *
     * @param  string  $email
     *
     * @return boolean
     */
    public function isExistEmail($email)
    {
        if ($this->model->whereEmail($email)->first()) {
            return true;
        }

        return false;
    }

    public function confirmed()
    {
        return $this->model->CONFIRMED;
    }

    /**
     * Search User
     *
     * @param  string $item
     *
     * @return mixed
     */
    public function searchUser($item)
    {
        $users =  $this->model->search($item)
            ->with('following', 'followers')
            ->get();
        if ($users->count()) {
            foreach ($users as $user) {
                $response[] = [
                    'status' => true,
                    'suggest' => $user->name,
                    'view' => view('', compact('user'))->render(),
                ];
            }

            return $response;
        }

        return false;
    }

    /**
     * Delete User Choosed
     *
     * @param  array $users
     * @return bool
     */
    public function deleteAll($users)
    {
        $admins = $this->model->where('role', config('settings.user.role.admin'))->get();
        $listUser = $users['users'];

        foreach ($admins as $admin)
        {
            if (in_array($admin->id, $users['users'])) {
                return false;
            }
        }

        $this->model->whereIn('id', $listUser)->get()->each(function ($user) {
            $user->delete();
        });

        return true;
    }

    public function confirmation($tokenConfirm)
    {
        return $this->model->where('token_confirm', $tokenConfirm);
    }

    public function findUser($facebookId)
    {
        return $this->model->where('facebook_id', $facebookId);
    }

    public function searchMember($name)
    {
        return $this->model->where('name', 'like', '%' . $name . '%');
    }

    public function userTop()
    {
        return $this->model->limit(10);
    }
}
