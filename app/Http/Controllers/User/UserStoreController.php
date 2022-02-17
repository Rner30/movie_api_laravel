<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Services\User\UserStoreService;
use Illuminate\Http\Request;

class UserStoreController extends Controller
{
    private $storeService;

    public function __construct(UserStoreService $storeService) {
       $this->storeService = $storeService;
    }

    public function __invoke(StoreUserRequest $request)
    {
        $newUser = ($this->storeService)($request);
        
        $token = $newUser->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'data' => $newUser,
            'token' =>$token
        ],201);
    }
}
