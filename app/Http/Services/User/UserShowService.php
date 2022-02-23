<?php

namespace App\Http\Services\User;

use App\Http\Resources\UserResource;
use App\Models\User;

final class UserShowService{
    
    public function __invoke($user)
    {
        $findUser = User::getUserById($user);
        return $findUser;
    }
}