<?php

namespace App\Http\Services\Movie;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

final class MovieIndexService{

    public function __invoke()
    {
        $allMovies = Movie::all();

        return MovieResource::collection($allMovies);
    }

}

