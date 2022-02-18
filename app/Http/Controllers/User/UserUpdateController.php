<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserUpdateService;
use Illuminate\Http\Request;

class UserUpdateController extends Controller
{
    private $userUpdateService;

    public function __construct(UserUpdateService $userUpdateService) {
        $this->userUpdateService = $userUpdateService;
    }

    public function __invoke(Request $request, $userId)
    {
        $token = auth()->user();
        
        if ($userId != $token->id) {
            return response()->json([
                'msg' => 'Solo puedes modificar usuarios teniendo su autenticacion'
            ],404);
        }
        
        return ($this->userUpdateService)($request, $userId);
    }
}
