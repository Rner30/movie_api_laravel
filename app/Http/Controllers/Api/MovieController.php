<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        $allMovies = Movie::all();

        return MovieResource::collection($allMovies);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $newMovie = new Movie();
        $newMovie->id = Str::uuid();
        $newMovie->title = $request->title;
        $newMovie->description = $request->description;
        $newMovie->publishDate = date('Y-m-d');
        $newMovie->image = $request->image;

        $newMovie->save();
        return response()->json($newMovie,201);
    }

    public function show($movie)
    {
        $search_movie = Movie::query()->find($movie);
        
        if (!isset($search_movie)) {
            return response()->json(["msg"=>"La pelicula no existe"],404);
        }

        return MovieResource::make($search_movie);
    }

    
    public function update(Request $request, $movie)
    {
        $findMovie = Movie::query()->find($movie);
        if (!isset($findMovie)) {
            return response()->json([
                'msg' => 'Pelicula no existente con ese id'
            ],404);
        }

        $findMovie->update($request->all());

        return response()->json([
            "msg" => $findMovie->title ." Pelicula actualizada"
        ],200);
    }

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
