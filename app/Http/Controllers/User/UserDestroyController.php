<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserDestroyService;

class UserDestroyController extends Controller
{   
    private $userDestroyService;

    public function __construct(UserDestroyService $userDestroyService) {
        $this->userDestroyService = $userDestroyService;
    }
    
    public function __invoke($id)
    {
        ($this->userDestroyService)($id);
        return response()->json([
            'msg' => 'Usuario eliminado'
        ]);
    }
}
