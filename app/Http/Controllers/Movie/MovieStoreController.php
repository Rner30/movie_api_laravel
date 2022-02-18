<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Services\Movie\MovieStoreService;
use Illuminate\Http\Request;

class MovieStoreController extends Controller
{
    private $movieStoreService;

    public function __construct(MovieStoreService $movieStoreService)
    {
        $this->movieStoreService = $movieStoreService;    
    }

    public function __invoke(StoreMovieRequest $request)
    {
        $newMovie = ($this->movieStoreService)($request);
        return response()->json($newMovie,201);
    }
}
