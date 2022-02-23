<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserDestroyService;
use App\Models\User;

class UserDestroyController extends Controller
{   
    private $userDestroyService;

    public function __construct(UserDestroyService $userDestroyService) {
        $this->userDestroyService = $userDestroyService;
    }
    
    public function __invoke(User $user)
    {
        $user->delete();
        return response()->status(200);
    }
}
