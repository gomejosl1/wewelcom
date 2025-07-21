<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API Key no proporcionada'
            ], SymfonyResponse::HTTP_UNAUTHORIZED);
        }

        // Buscar el usuario con ese API Key
        $user = User::where('api_key', $apiKey)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'API Key inválida'
            ], SymfonyResponse::HTTP_UNAUTHORIZED);
        }

        // Establecer el usuario autenticado
        auth()->login($user);

        return $next($request);
    }
}
