<?php

namespace App\Http\Services\Movie;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Movie;
use Illuminate\Support\Str;

final class MovieStoreService{

    public function __invoke(StoreMovieRequest $request)
    {
        $newMovie = new Movie();
        $newMovie->id = Str::uuid();
        $newMovie->title = $request->title;
        $newMovie->description = $request->description;
        $newMovie->publishDate = date('Y-m-d');
        $newMovie->image = $request->image;

        $newMovie->save();
        return $newMovie;
    }

}