<?php

namespace App\Http\Services\User;

use App\Http\Resources\UserResource;
use App\Models\User;

final class UserShowService{
    
    public function __invoke($userId)
    {
        $userExists = User::query()->with('movies')->find($userId);
          
        if (!isset($userExists)) {
            return response()->json([
                'msg' => "Usuario no encontrado"
            ],404);
        }

        return $userExists;
    }
}