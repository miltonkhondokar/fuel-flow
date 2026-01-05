<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Services\RouteService;
use Illuminate\Support\Facades\App;

class AuthCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        // Skip authentication check for these routes
        $exemptRoutes = ['login', 'register', '/'];

        // If user is not authenticated
        if (!Auth::check()) {
            // Allow access to exempt routes
            if ($request->is($exemptRoutes)) {
                return $next($request);
            }
            return redirect()->route('login');
        }

        // If user is authenticated but trying to access login/register
        if ($request->is('login', 'register')) {

            $service = App::make(RouteService::class);
            return redirect()->route($service->getDashboardRoute());
        }

        $response = $next($request);

        // Apply security headers to non-file responses
        if (!$response instanceof BinaryFileResponse) {
            $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        }

        return $response;
    }
}
