<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Services\User\UserShowService;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    private $userShowService;

    public function __construct(UserShowService $userShowService) {
        $this->userShowService = $userShowService;
    }

    public function __invoke($userId)
    {
        $user = ($this->userShowService)($userId);
        
        return UserResource::make($user) ;
    }
}
