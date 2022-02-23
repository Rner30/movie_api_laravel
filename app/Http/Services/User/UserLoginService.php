<?php

namespace App\Http\Services\User;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UserLoginService {

    public function __invoke(LoginUserRequest $request)
    {
        $user = User::getUserByEmail($request->email);

        $passwordVerify = Hash::check($request->password,$user->password);

        if (!$passwordVerify) {
            return response()->json(['msg'=> 'Password incorrecta']);
        }

        return $user;
    }
}