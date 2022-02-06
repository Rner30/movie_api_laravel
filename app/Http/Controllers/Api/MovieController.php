<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        $allMovies = Movie::all();

        return response()->json([
            $allMovies
        ],200);
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
        return response()->json($newMovie,200);
    }

    public function show($movie)
    {
        $search_movie = Movie::query()->find($movie)->first();
        
        if (!isset($search_movie)) {
            return response()->json(["msg"=>"La pelicula no existe"]);
        }

        return $search_movie;
    }

    
    public function update(Request $request, $movie)
    {
        $findMovie = Movie::query()->find($movie);
        if (!isset($findMovie)) {
            return response()->json([
                'msg' => 'Pelicula no existente con ese id'
            ]);
        }

        $findMovie->update($request->all());
        return response()->json([
            "msg" => "Pelicula actualizada"
        ]);
    }

    public function destroy($movie)
    {
        $deleteMovie = Movie::query()->find($movie);
        
        if (!isset($deleteMovie)) {
            return response()->json(['msg'=>'La pelicula no existe']);
        }

        $deleteMovie->delete();
        return response()->json($deleteMovie,200);
    }
}
