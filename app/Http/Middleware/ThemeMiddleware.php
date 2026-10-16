<?php

namespace App\Http\Middleware;

use App\Support\SiteCache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ThemeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        view()->share('theme', SiteCache::themePath());

        // Log untuk debugging
        // Log::info('Theme Middleware dijalankan dengan tema: ' . ($theme ? $theme->path : 'default'));

        return $next($request);
    }
}
