<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Services\User\UserShowService;
use App\Models\User;
use Illuminate\Http\Request;

class UserShowController extends Controller
{
    private $userShowService;

    public function __construct(UserShowService $userShowService) {
        $this->userShowService = $userShowService;
    }

    public function __invoke($user)
    {   
        return ($this->userShowService)($user);
        
    }
}
