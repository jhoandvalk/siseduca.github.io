<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;


class JwtMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            // dd($e);
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                abort(401, 'Autorización inválida.');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                abort(401, 'Autorización expirada.');
            }else{
                abort(401, 'No existe autorización.');
            }
        }
        return $next($request);
    }
}
