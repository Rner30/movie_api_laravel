<?php 

namespace App\Http\Services\User;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

final class UserUpdateService{
    public function __invoke(Request $request, $userId)
    {
        $findUser = User::query()->find($userId);
        $findUser->update($request->all());
        return UserResource::make($findUser);
    }
}