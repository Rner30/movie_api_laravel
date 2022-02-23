<?php

namespace App\Http\Services\User;

use App\Models\Movie;
use App\Models\User;

final class UserSaveMoviesService {
    
    public function __invoke($user,$movie,$seconds)
    {
        if ($user->movies->contains($movie)) {
            $user->movies()->detach($movie);
            return response()->json(["msg"=> "La pelicula fue quitada"],200);
        }
    
        $user->movies()->attach($movie,['seconds' => $seconds ]);
        
        
        return response()->json(["msg"=>"Pelicula agregada al usuario"],200);
    }
}