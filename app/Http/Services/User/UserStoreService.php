<?php

namespace App\Http\Services\User;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserStoreService{

    public function __invoke(StoreUserRequest $request)
    {
        $newUser = new User();
        $newUser->id = Str::uuid();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->is_admin = $request->is_admin ? : 0;

        $newUser->save();

        return $newUser;
    }
}

