<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Services\Movie\MovieDestroyService;
use App\Models\Movie;

class MovieDestroyController extends Controller
{
    private $movieDestroyService;

    public function __construct(MovieDestroyService $MovieDestroyService) {
        $this->movieDestroyService  = $MovieDestroyService ;
    }

    public function __invoke($movie)
    {
        $deleteMovie = Movie::query()->find($movie);
        
        if (!isset($deleteMovie)) {
            return response()->json(['msg'=>'La pelicula no existe'],404);
        }
        return ($this->movieDestroyService)($deleteMovie);
    }
}
