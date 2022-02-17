<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserSaveMoviesService;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class UserSaveMoviesController extends Controller
{
    private $userSaveMoviesService;

    public function __construct(UserSaveMoviesService $userSaveMoviesService)
    {
        $this->userSaveMoviesService = $userSaveMoviesService;
    }

    public function __invoke(Request $request)
    {
        $token = auth()->user();

        $seconds = $request->seconds;

        $user = User::query()->with('movies')->find($token->id)->first();

        $movie = Movie::query()->find($request->movie);
        
        return ($this->userSaveMoviesService)($user,$movie,$seconds);
    }
}