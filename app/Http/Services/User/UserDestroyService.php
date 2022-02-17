<?php

namespace App\Http\Services\User;

use App\Models\User;

final class UserDestroyService{
    
    public function __invoke($id)
    {
        $user = User::destroy($id);
        
        if (!isset($user)) {
            return response()->json([
                'msg' => 'No existe un usuario con ese id'
            ]);
        }

        return $user;
    }
}