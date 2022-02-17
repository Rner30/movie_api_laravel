<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Services\User\UserLoginService;

class UserLoginController extends Controller
{
    private $loginService;

    public function __construct(UserLoginService $loginService) {
        $this->loginService = $loginService;
    }

    public function __invoke(LoginUserRequest $request)
    {
        $user = ($this->loginService)($request);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['Token' => $token,'User'=>$user],200);
    }
}
