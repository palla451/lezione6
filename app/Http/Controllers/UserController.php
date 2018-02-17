<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

// -- imposto il parametro User come parametro in ingresso sul construttore

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function register(Request $request){
        $user = $this->user->create([
            'name' => $request->get('fldNome'),
            'email' => $request->get('fldEmail'),
            'password' => bcrypt($request->get('fldPasswd')),
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'utente creato correttamente',
            'data'      => $user
        ]);
    }

    public function login(Request $request){

    }
}
