<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
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
        $response = $next($request);

        if ($response instanceof Response && !app()->environment('local')) {
            // Obtener el contenido de la respuesta
            $content = $response->getContent();

            // Reemplazar todas las URLs HTTP por HTTPS
            $content = preg_replace('#http://([^/]*)/#', 'https://$1/', $content);

            // Establecer el contenido modificado en la respuesta
            $response->setContent($content);
        }

        return $response;
    }
}
