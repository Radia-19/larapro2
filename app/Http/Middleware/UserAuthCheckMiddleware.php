<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use Log;
class UserAuthCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('UserAuthCheckMiddleware invoked.');
        if(Auth::check()){
            Log::info('User authenticated.');
            return $next($request);
        }else{
            Log::warning('User not authenticated. Redirecting...');
            return to_route('user.login.show')->with('error','You Must Login First!');
        }
    }
}
