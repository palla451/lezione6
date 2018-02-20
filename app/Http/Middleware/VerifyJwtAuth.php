<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // --- Recupero il token dalle chiamate HTTP
        $token = JWTAuth::getToken();

        // === Verificare la correttezza del token presente
        // === nelle chiamate HTTP

        try
        {
            // === Verifico che sia un token valido
            // === ottenendo lo user a cui è abbinato
            $user = JWTAuth::toUser($token);

            // === Mostro che lo User che si è autenticato
            Log::info($user);
        }
        catch (JWTException $exception)
        {
            if($exception instanceof TokenExpiredException)
            {
                return response()->json(['token expired'], $exception->getStatusCode());
            } else if ($exception instanceof TokenInvalidException)
            {
                return response()->json(['invalid token'], $exception->getStatusCode());
            } else {
                return response()->json(['token obbligatorio'], 442);
            }
        }

        return $next($request);
    }
}
