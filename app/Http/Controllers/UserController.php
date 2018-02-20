<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
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


    public function register(Request $request)
    {
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

    public function login(Request $request)
    {
        // === Recupero le credenziali d'accesso
        $credentials = $request->only('email','password');

        // === Dichiaro una variabile che rappresenta il token
        $token="";

        try
        {
            // Verifico che queste credenziali siano valide
            $token  = JWTAuth::attempt($credentials);

            if (!$token)
            {
                //  -- emetto una risposta HTTP 422
                return response()
                    ->json(['credenziali accesso errate'],442);
            }
        }
        catch (JWTException $exception)
        {
            // -- emetto una risposta HTTP 500, ci sono degli impedimenti
            // nella creazione del token
            return response()
                ->json(['impossibile creare token'],500);
        }

        return response()
            ->json(compact('token'),200);
    }
}
