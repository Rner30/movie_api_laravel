<?php

namespace App\Http\Services\Movie;

use App\Models\Movie;

final class MovieUpdateService{
    public function __invoke($request,$findMovie)
    {
        $findMovie->update($request->all());

        return response()->json([
            "msg" => $findMovie->title ." Pelicula actualizada"
        ],200);
    }
}