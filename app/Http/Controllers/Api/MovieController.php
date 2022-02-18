<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function destroy($movie)
    {
        $deleteMovie = Movie::query()->find($movie);
        
        if (!isset($deleteMovie)) {
            return response()->json(['msg'=>'La pelicula no existe'],404);
        }

        $deleteMovie->delete();
        return MovieResource::make($deleteMovie);
    }
}
