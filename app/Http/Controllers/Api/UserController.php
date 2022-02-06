<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{ 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        $newUser = new User();
        $newUser->id = Str::uuid();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);

        $newUser->save();
        return response()->json($newUser,200);
    }

    public function show($userId)
    {
        $userExists = User::query()->with('movies')->find($userId);

        if (!isset($userExists)) {
            return response()->json([
                'msg' => "Usuario no encontrado"
            ],404);
        }

        return response()->json([
            $userExists
        ],200);
    }

   
    public function update(Request $request, $userId)
    {
        $findUser = User::query()->find($userId);
        if (!isset($findUser)) {
            return response()->json([
                'msg' => 'Usuario no existente con ese id'
            ]);
        }
        $findUser->update($request->all());
        return response()->json($findUser,200);
    }

   
    public function destroy($id)
    {
        //
    }

    // /api/user/save-movies/{userId}
    public function saveMovies(Request $request ,$userId)
    {
        $userExists = User::query()->with('movies')->find($userId)->first();

        $movie = Movie::query()->find($request->movie);
        
        if (!isset($userExists) || !isset($movie)) {
            return response()->json([
                'msg' => 'No existe usuario O pelicula con ese ID'
            ]);
        }

        if ($userExists->movies->contains($movie)) {
            $userExists->movies()->detach($movie);
            return response()->json(["msg"=> "La pelicula fue quitada"]);
        }
    
        $userExists->movies()->attach($movie);
        
        return response()->json(["msg"=>"Pelicula agregada al usuario"]);
    }
}
