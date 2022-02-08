<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{ 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:5'
        ]);

        $user = User::query()->with('movies')->where('email','=',$request->email)->first();

        $passwordVerify = Hash::check($request->password,$user->password);

        if (!$passwordVerify) {
            return response()->json(['msg'=> 'Password incorrecta']);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['Token' => $token,'User'=>$user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'is_admin' => 'boolean'
        ]);

        $newUser = new User();
        $newUser->id = Str::uuid();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->is_admin = $request->is_admin ? : 0;

        $newUser->save();
        $token = $newUser->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $newUser,
            'token' =>$token
        ],201);
    }

    public function show($userId)
    {
        $userExists = User::query()->with('movies')->find($userId);
          
        if (!isset($userExists)) {
            return response()->json([
                'msg' => "Usuario no encontrado"
            ],404);
        }

        return UserResource::make($userExists);
    }

   
    public function update(Request $request, $userId)
    {
        $token = auth()->user();
        
        if ($userId != $token) {
            return response()->json([
                'msg' => 'Usuario no existente con ese id o token'
            ],404);
        }
        $findUser = User::query()->find($userId);
        $findUser->update($request->all());
        return UserResource::make($findUser);
    }

   
    public function destroy($id)
    {
        $user = User::destroy($id);
        if (!isset($user)) {
            return response()->json([
                'msg' => 'No existe un usuario con ese id'
            ]);
        }
        return response()->json([
            'msg' => 'Usuario eliminado'
        ]);
    }

    // /api/user/save-movies/{userId}
    public function saveMovies(Request $request)
    {
        $token = auth()->user();

        $user = User::query()->with('movies')->find($token->id)->first();

        $movie = Movie::query()->find($request->movie);
        
        if (!isset($user) || !isset($movie)) {
            return response()->json([
                'msg' => 'No existe usuario O pelicula con ese ID'
            ],404);
        }

        if ($user->movies->contains($movie)) {
            $user->movies()->detach($movie);
            return response()->json(["msg"=> "La pelicula fue quitada"],200);
        }
    
        $user->movies()->attach($movie);
        
        return response()->json(["msg"=>"Pelicula agregada al usuario"],200);
    }
}
