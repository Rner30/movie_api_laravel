<?php

namespace App\Http\Services\Movie;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

final class MovieShowService{

    public function __invoke($movie)
    {
        $search_movie = Movie::query()->find($movie);
        
        if (!isset($search_movie)) {
            return response()->json(["msg"=>"La pelicula no existe"],404);
        }

        return MovieResource::make($search_movie);
    }

}