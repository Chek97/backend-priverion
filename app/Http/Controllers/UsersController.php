<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();
        
        return response()->json(["Result" => $users], 201);
    }

    public function auth(Request $request){
        $credentials = $request->only('username', 'password');

        try {
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'datos incorrectos', 400]);
            }
        } catch (JWTException $th) {
            return response()->json(['error' => 'no se pudo crear el token'], 500);
        }
        return response()->json(['ok' => 'el login es correcto', 'token' => $token]);
    }

    public function store(Request $request){
        $user = new User;

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $token = JWTAuth::fromUser(User::create(["name" => $request->name, "last_name" => $request->last_name, "email"=> $request->email,
        "username" => $request->username, "password" => Hash::make($request->password)
    ]));

        return response()->json(["status" => "ok", "user" => $user, "token" => $token], 201);
    }
}
