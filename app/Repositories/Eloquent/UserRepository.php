<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create($data);
    }
}