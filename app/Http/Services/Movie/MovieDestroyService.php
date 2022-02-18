<?php

namespace App\Http\Services\Movie;

use App\Http\Resources\MovieResource;
use App\Models\Movie;

final class MovieDestroyService{
    public function __invoke($deleteMovie)
    {
        $deleteMovie->delete();
        return MovieResource::make($deleteMovie);
    }
}