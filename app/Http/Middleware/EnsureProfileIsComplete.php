<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    
        // Allow user to access any route named starting with "profile.setup"
        if ($user && is_null($user->job_description)) {
            if (!$request->routeIs('profile.setup*')) {
                return redirect()->route('profile.setup');
            }
        }
    
        return $next($request);
    }
}
